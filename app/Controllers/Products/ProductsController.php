<?php

namespace App\Controllers\Products;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProductsController extends BaseController
{
    public function index()
    {
        return view('pages/product_listings');
        
    }

     /**
     * Get User Listing s
     * User Images 
     * Return to View 
     */
    public function MyListings()
    {
        $user = auth()->user();
        $productModel = new \App\Models\ProductModel();
        $universityModel = new \App\Models\UniversitiesModel();
        $stateModel = new \App\Models\StatesModel();
        $university = $universityModel->find($user->university_id);
        $state = $stateModel->find($user->state_id);

          // Get User Listings with Status and First Image
        $listings = $productModel
            ->select('products.*, statuses.name AS status_name, product_images.image_path')
            ->join('statuses', 'statuses.id = products.status_id')
            ->join(
                'product_images',
                'product_images.id = 
                 (
                    SELECT pi.id
                    FROM product_images AS pi 
                    WHERE pi.product_id = products.id
                    ORDER BY pi.sort_order ASC, pi.id ASC
                    LIMIT 1
                )','left', false)
            ->where('products.user_id', $user->id)
            ->orderBy('products.created_at', 'DESC')
            ->findAll();

        return view('pages/my-listings', [
            'listings' => $listings,
            'user' => $user,
            'university' => $university,
            'state' => $state,

        ]);
    }

    public function markAsSold($id)
    {

        $productModel = new \App\Models\ProductModel();

        //Get the product 
        $product = $productModel->find($id);

        //Check if product exists
        if(!$product){
            return redirect()->back()->with('error' , 'Product not found.');
        }


        //Make Sure User Owns the Current Product
        if((int) $product['user_id'] !== auth()->id()){
            return redirect()->back()->with('error' , 'You are not Allowed.');
        }

        //Get the Sold status 
        $statusModel = new \App\Models\StatusesModel();
        $soldStatus = $statusModel->where('name' , 'Sold')->first();

        if(!$soldStatus){
            return redirect()->back()->with('error' , 'Sold Status Not Found.');
        }

        //Update Product Status
        $productModel->update($id, [
            'status_id' => $soldStatus['id']
        ]);

        return redirect()->back()->with('success' , 'Product marked as sold.');

    }

    public function markAsActive($id){
        
        $productModel = new \App\Models\ProductModel();

        //Get the product 
        $product = $productModel->find($id);

        //Check if product exists
        if(!$product){
            return redirect()->back()->with('error' , 'Product not found.');
        }

        //Make Sure User Owns the Current Product
        if((int) $product['user_id'] !== auth()->id()){
            return redirect()->back()->with('error' , 'You are not Allowed.');
        }

        //Get the Active status 
        $statusModel = new \App\Models\StatusesModel();
        $activeStatus = $statusModel->where('name' , 'Active')->first();

        if(!$activeStatus){
            return redirect()->back()->with('error' , 'Active Status Not Found.');
        }

        //Update Product Status
        $productModel->update($id, [
            'status_id' => $activeStatus['id']
        ]);

        return redirect()->back()->with('success' , 'Product marked as active.');
    }

    /**
     * Get User Listing 
     * User Images 
     * Return to View 
     * for single product page
     */
    public function view($product_id)
    {   
        $productModel = new \App\Models\ProductModel();

        $product = $productModel
            ->select('
                products.*,
                conditions.name AS condition_name,
                statuses.name AS status_name,
                brands.name AS brand_name,
                categories.name AS category_name,
                users.first_name AS seller_first_name,
                users.last_name AS seller_last_name,
                users.avatar AS seller_avatar, 
                users.created_at AS seller_joined_at,
                Campuses.name AS university_name,
                states.name AS state_name
            ')
            ->join('categories', 'categories.id = products.category_id')
            ->join('brands', 'brands.id = brand_id' , 'left')
            ->join('conditions', 'conditions.id = products.condition_id')
            ->join('statuses', 'statuses.id = products.status_id')
            ->join('users', 'users.id = products.user_id')
            ->join('Campuses', 'Campuses.id = users.university_id')
            ->join('states', 'states.id = Campuses.state_id')
            ->find($product_id);

        if (!$product) {
            return redirect()->back()
                ->with('error', 'Listing not found.');
        }
        
        //DB Connect
        $db = \db_connect();
        //Related Products 
        $relatedProducts = $db->table('products')
                        ->select('
                            products.*,
                            statuses.name AS status_name,
                            conditions.name AS condition_name,
                            users.first_name AS seller_first_name,
                            users.last_name AS seller_last_name,
                            Campuses.name AS university_name,
                            ')
                            ->join(
                                'conditions',
                                'conditions.id = products.condition_id'
                            )
                            ->join(
                                'statuses',
                                'statuses.id = products.status_id'
                            )
                            ->join(
                                'users',
                                'users.id = products.user_id'
                            )
                            ->join(
                                'Campuses',
                                'Campuses.id = users.university_id'
                            )
                            ->where('category_id' , $product['category_id'])
                            ->where('products.id != ' , $product['id'])
                            ->where('status_id' ,1)
                            ->orderBy('id' , 'DESC')
                            ->get()
                            ->getResultArray();

        $productImageModel = new \App\Models\ProductImagesModel();
        $categoriesModel = new \App\Models\CategoriesModel();

        //Product Images[]
        $images = $productImageModel
            ->where('product_id', $product_id)
            ->orderBy('sort_order', 'ASC')
            ->findAll();
        //Product Categories 
        $categories = $categoriesModel
                ->orderBY('id' , 'ASC')
                ->findAll();

        //Append Related Product Main Image 
        foreach($relatedProducts as  &$rp){

            //Get Main Image
            $image = $productImageModel
            ->where('product_id', $rp['id'])
            ->orderBy('id', 'ASC')
            ->first();

            $rp['image_path'] = $image['image_path'] ?? [];
        }

        return view('pages/show-product', [
            'product' => $product,
            'images'  => $images,
            'relatedProducts'  => $relatedProducts,
            'categories'  => $categories,
        ]);
    }
    /**
     * Return Create View and Product Categories 
     */
    public function create()
    {
        $categoriesModel = new \App\Models\CategoriesModel();

        $categories = $categoriesModel->find();

        return view('pages/create', [
            'categories' => $categories
        ]);

    }
    /**
     * Check if a user has the Create Session Then return the page with 
     * Brands and Conditiions of products 
     */
    public function details()
    {

        //Check if user has a create session 
        if( !session()->has('product_title' ,'product_category' )){
            return  redirect()->to('products/create')
                    ->with('error' , 'Please start creating your product first');
        }

        $BrandModel = new \App\Models\BrandModel();
        $brands = $BrandModel->find();
        // 
        $ConditionsModel = new \App\Models\ConditionsModel();
        $conditions = $ConditionsModel->find();

        return view('pages/create_details' , [
            'brands' => $brands,
            'conditions' => $conditions,
        ]);
    }

    /**
     * Get User Basic Product Information
     * Validate The Info 
     * Store In a Session
     */
    public function StoreBasicInfo()
    {
        $rules = [
            'title' => [
                'label' => 'product_title',
                'rules' => 'required|min_length[10]|max_length[70]',
                'errors' => [
                    'required' => 'Please enter Product title.',
                    'min_length' => 'Product title must be at least 10 characters.',
                    'max_length' => 'Product title cannot exceed 70 characters.'
                ]
            ],
            'category_id' => [
                'label' => 'product_category',
                'rules' => 'required|integer|is_not_unique[categories.id]',
                'errors' => [
                    'required' => 'Please enter Product category.',
                    'integer' => 'Invalid  category.',
                    'is_not_unique' => 'The selected category does not exist.',
                ]
            ],
        ];

        //Return Validation Errors 
        if(! $this->validate($rules)){
            return  redirect()->back()
                    ->withInput()
                    ->with('errors' , $this->validator->getErrors());
        }
        
        //set Create session
        session()->set([
            'product_title' => trim($this->request->getPost('title')),
            'product_category' => trim($this->request->getPost('category_id')),
        ]);

        return redirect()->to('products/create/details');
    }
    /**
     * Get User Produt Details
     * Validate 
     * Get Create Session 
     * Insert Them in to the Database  
     */
    public function store()
    {
        // Get Step 1 data from session
        $productTitle = session()->get('product_title');
        $productCategory = session()->get('product_category');

        // Prevent direct access to create/details
        if (! $productTitle || ! $productCategory) {
            return redirect()->to('/products/create')
                ->with('error', 'Please start creating your product first.');
        }

        // 2. Validate Step 2 fields
        $rules = [
            'brand_id' => [
                'label' => 'Brand',
                'rules' => 'required|integer|is_not_unique[brands.id]',
                'errors' => [
                    'required'      => 'Please select a brand.',
                    'integer'       => 'Invalid brand.',
                    'is_not_unique' => 'The selected brand does not exist.',
                ],
            ],

            'condition_id' => [
                'label' => 'Condition',
                'rules' => 'required|integer|is_not_unique[conditions.id]',
                'errors' => [
                    'required'      => 'Please select the product condition.',
                    'integer'       => 'Invalid condition.',
                    'is_not_unique' => 'The selected condition does not exist.',
                ],
            ],

            'description' => [
                'label' => 'Description',
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required'   => 'Please provide a description.',
                    'min_length' => 'Description must be at least 10 characters.',
                ],
            ],

            'price' => [
                'label' => 'Price',
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required'   => 'Please enter a price.',
                    'numeric'     => 'Price must be a valid number.',
                    'greater_than' => 'Price must be greater than 0.',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }


        // Get uploaded images
        $images = $this->request->getFileMultiple('images');

        // Validate images
        if (empty($images)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please upload at least one product image.');
        }

        // Remove empty file inputs
        $images = array_filter($images, function ($image) {
            return $image->getError() !== UPLOAD_ERR_NO_FILE;
        });

        // Maximum of 4 images
        if (count($images) > 4) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'You can upload a maximum of 4 images.');
        }

        // Validate each image
        foreach ($images as $image) {

            if (! $image->isValid()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'One or more uploaded images are invalid.');
            }

            if ($image->getSize() > 5 * 1024 * 1024) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Each image must not exceed 5MB.');
            }

            if (! in_array(
                strtolower($image->getExtension()),
                ['jpg', 'jpeg', 'png', 'webp']
            )) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Only JPG, JPEG, PNG and WEBP images are allowed.');
            }
        }

        // Prepare product data
        $productData = [
            'user_id'     => auth()->id(),
            'category_id' => $productCategory,
            'brand_id'    => $this->request->getPost('brand_id'),
            'condition_id'=> $this->request->getPost('condition_id'),
            'status_id' => 1,
            'title'       => $productTitle,
            'description' => trim($this->request->getPost('description')),
            'price'       => $this->request->getPost('price'),
        ];

        // Insert product
        $productModel = new \App\Models\ProductModel();
        $imageModel   = new \App\Models\ProductImagesModel();

        $db = \Config\Database::connect();

        $db->transStart();

        //insert prepared product
        $productModel->insert($productData);

        //Get produt id
        $productId = $productModel->getInsertID();
        //Create product upload directory
        $uploadPath = FCPATH . 'uploads/product_images/';

        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $storedFiles = [];
        foreach ($images as $index => $image) {

            $newName = $image->getRandomName();
            $image->move($uploadPath, $newName);

            $storedFiles[] = $uploadPath . $newName;

            $imageModel->insert([
                'product_id' => $productId,
                'image_path' => 'uploads/product_images/' . $newName,
                'sort_order' => $index,

            ]);
        }


        //Complete transaction
        $db->transComplete();

        if ($db->transStatus() === false) {
            //if the insert failed delete all the saved images 
            foreach ($storedFiles as $filePath) {
                if (is_file($filePath)) {
                    unlink($filePath);
                }
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong while creating your product. Please try again.');
        }


        //Clear Step 1 session
        session()->remove([
            'product_title',
            'product_category',
        ]);


        //Success
        return redirect()->to('/products/my-listings')
            ->with('success', 'Your product has been posted successfully.');
    }


    /**
     * 
     * EDIT STEP 1 - Show Basic Info Form
     * Reuses current  create view
     * 
     */
    public function editBasic($id)
    {
        // Get logged user
        $userId = auth()->id();

        // Find product and make sure it belongs to this user
        $productModel = new \App\Models\ProductModel();
        $product = $productModel->where('id', $id)->where('user_id', $userId)->first();

        // Redirect if product not found or doesn't belong to user
        if (!$product) {
            return redirect()->to('/products/my-listings')->with('error', 'Listing not found or not allowed.');
        }

        // Put existing data into session so it follows listing  create flow 
        // This allows user to go from step 1 to step 2
        session()->set([
            'edit_product_id' => $product['id'], // Track which product we are editing
            'product_title' => $product['title'],
            'product_category' => $product['category_id'],
        ]);

        // Get all categories
        $categoryModel = new \App\Models\CategoriesModel();

        // Load SAME view we used  create, but with edit data
        return view('pages/edit', [
            'categories' => $categoryModel->findAll(),
            'product' => $product, 
            'isEdit' => true, 
        ]);
    }

    /**
     * 
     * EDIT STEP 1 - Validate and Store in Session
     * 
     */
    public function StoreEditBasicInfo($id)
    {
        $userId = auth()->id();
        $productModel = new \App\Models\ProductModel();

        //Check if product belongs to this user
        $product = $productModel->where('id', $id)->where('user_id', $userId)->first();
        if (!$product) {
            return redirect()->to('/products/my-listings')->with('error', 'Not allowed.');
        }

        // Same validation rules as  create 
        $rules = [
            'title' => [
                'label' => 'product_title',
                'rules' => 'required|min_length[10]|max_length[70]',
                'errors' => [
                    'required' => 'Please enter Product title.',
                    'min_length' => 'Product title must be at least 10 characters.',
                    'max_length' => 'Product title cannot exceed 70 characters.'
                ]
            ],
            'category_id' => [
                'label' => 'product_category',
                'rules' => 'required|integer|is_not_unique[categories.id]',
                'errors' => [
                    'required' => 'Please enter Product category.',
                    'integer' => 'Invalid category.',
                    'is_not_unique' => 'The selected category does not exist.',
                ]
            ],
        ];

        // If validation fails, go back with errors
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save Session data for step 2
        session()->set([
            'edit_product_id' => $id,
            'product_title' => trim($this->request->getPost('title')),
            'product_category' => trim($this->request->getPost('category_id')),
        ]);

        return redirect()->to("products/$id/edit/details")->with('success', 'Almost there. Now edit the Listing details.');
    }

    /**
     *
     * EDIT STEP 2 - Show Details Form
     * 
     */
    public function editDetails($id)
    {
        // Get data from session 
        $productTitle = session()->get('product_title');
        $productCategory = session()->get('product_category');
        $editId = session()->get('edit_product_id');

        // If someone tries to access step 2 directly without step 1, send them back
        if (!$productTitle ||!$productCategory || $editId!= $id) {
            return redirect()->to("products/$id/edit")->with('error', 'Please complete step 1 first.');
        }

        // Security check
        $productModel = new \App\Models\ProductModel();
        $product = $productModel->where('id', $id)->where('user_id', auth()->id())->first();
        if (!$product) {
            return redirect()->to('/products/my-listings')->with('error', 'Not found');
        }

        // Get existing images for this product
        $imageModel = new \App\Models\ProductImagesModel();
        $images = $imageModel->where('product_id', $id)->orderBy('id', 'ASC')->findAll();

        // Get dropdown data
        $brandModel = new \App\Models\BrandModel();
        $conditionModel = new \App\Models\ConditionsModel();

        // Load SAME view for create details, but with edit data
        return view('pages/edit_details', [
            'product' => $product,
            'images' => $images ?? [], // empty array user doest have images yet
            'brands' => $brandModel->findAll(),
            'conditions' => $conditionModel->findAll(),
            'isEdit' => true,
        ]);
    }

    /**
     * 
     * EDIT STEP 2 - Validate User Details
     * delete Old images
     * insert data 
     * and the insert new images 
     * 
     */
    public function update($id)
    {
        $userId = auth()->id();
        $productModel = new \App\Models\ProductModel();
        $imageModel = new  \App\Models\ProductImagesModel();

        //Check ownership
        $product = $productModel->where('id', $id)->where('user_id', $userId)->first();
        if (!$product) {
            return redirect()->to('/products/my-listings')->with('error', 'Not allowed');
        }

        // Check session data from step 1
        $productTitle = session()->get('product_title');
        $productCategory = session()->get('product_category');
        $editId = session()->get('edit_product_id');

        if (!$productTitle ||!$productCategory || $editId!= $id) {
            return redirect()->to("products/$id/edit")->with('error', 'Session expired. Start again.');
        }

        // Validate step 2 fields
        $rules = [
            'brand_id' => [
                'label' => 'Brand',
                'rules' => 'required|integer|is_not_unique[brands.id]',
                'errors' => ['is_not_unique' => 'Brand does not exist.']
            ],
            'condition_id' => [
                'label' => 'Condition',
                'rules' => 'required|integer|is_not_unique[conditions.id]',
                'errors' => ['required' => 'Please select condition.']
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'required|min_length[10]',
                'errors' => ['required' => 'Please provide description.']
            ],
            'price' => [
                'label' => 'Price',
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => ['required' => 'Please enter price.']
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle images
        // Get uploaded new images from form
        $files = $this->request->getFiles();
        $newImages = $files['images'] ?? [];

        // Remove empty file inputs
        $newImages = array_filter($newImages, function ($img) {
            return $img->getError() !== UPLOAD_ERR_NO_FILE;
        });

        // Get existing images count from DB
        $existingImages = $imageModel->where('product_id', $id)->findAll();
        $existingCount = count($existingImages);

        // If user uploaded new images, we will DELETE old ones
        // If no new images uploaded, we KEEP old ones (don't delete)
        $shouldReplaceImages = count($newImages) > 0;

        if ($shouldReplaceImages) {
            // Validate new images count
            if (count($newImages) > 4) {
                return redirect()->back()->withInput()->with('error', 'Max 4 images allowed.');
            }

            // Validate each new image size/type
            foreach ($newImages as $image) {
                if (!$image->isValid()) {
                    return redirect()->back()->withInput()->with('error', 'Invalid image uploaded.');
                }
                if ($image->getSize() > 5 * 1024 * 1024) {
                    return redirect()->back()->withInput()->with('error', 'Each image max 5MB.');
                }
                if (!in_array(strtolower($image->getExtension()), ['jpg','jpeg','png','webp'])) {
                    return redirect()->back()->withInput()->with('error', 'Only JPG, PNG, WEBP allowed.');
                }
            }
        }

        // START DATABASE TRANSACTION
        $db = \Config\Database::connect();
        $db->transStart();

        // Update product table with new data from session + post
        $productModel->update($id, [
            'category_id' => $productCategory,
            'brand_id' => $this->request->getPost('brand_id'),
            'condition_id' => $this->request->getPost('condition_id'),
            'title' => $productTitle,
            'description' => trim($this->request->getPost('description')),
            'price' => $this->request->getPost('price'),
        ]);

        // IF NEW IMAGES UPLOADED, DELETE OLD IMAGES FROM FOLDER AND DB
        if ($shouldReplaceImages) {
            //  UNLINK  old image files from server folder
            foreach ($existingImages as $oldImg) {
                $oldFilePath = FCPATH. $oldImg['image_path']; 
                // Check if file exists before deleting
                if (is_file($oldFilePath)) {
                    unlink($oldFilePath); 
                }
            }

            // Delete old image records from database
            $imageModel->where('product_id', $id)->delete();

            //  Upload and insert NEW images
            $uploadPath = FCPATH. 'uploads/product_images/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true); 
            }

            foreach ($newImages as $index => $image) {
                $newName = $image->getRandomName(); 
                $image->move($uploadPath, $newName);

                $storedFiles[] = $uploadPath . $newName;

                // Save new image path to database
                $imageModel->insert([
                    'product_id' => $id,
                    'image_path' => 'uploads/product_images/'. $newName,
                    'sort_order' => $index,
                ]);
            }
        }

        //  Complete transaction
        $db->transComplete();

        if ($db->transStatus() === false) {

             //if the insert failed delete all the saved images 
            foreach ($storedFiles as $filePath) {
                if (is_file($filePath)) {
                    unlink($filePath);
                }
            }
            return redirect()->back()->withInput()->with('error', 'Failed to update listing.');
        }

        //  Clear edit session data
        session()->remove(['product_title', 'product_category', 'edit_product_id']);

        // Success - go to listing page
        return redirect()->to("products/my-listings")->with('success', 'Listing updated successfully.');
    }

    /**
     * Delete single image via AJAX or link
     */
    public function deleteImage($imageId)
    {
        $imageModel = new  \App\Models\ProductImagesModel();
        $image = $imageModel->find($imageId);

        if (!$image) return redirect()->back()->with('error', 'Image not found');

        $productModel = new \App\Models\ProductModel();
        $product = $productModel->find($image['product_id']);

        // Check owner
        if ((int)$product['user_id']!= auth()->id()) {
            return redirect()->back()->with('error', 'Not allowed');
        }

        // Don't allow deleting last image
        // $count = $imageModel->where('product_id', $image['product_id'])->countAllResults();
        // if ($count <= 1) {
        //     return redirect()->back()->with('error', 'Cannot delete last image. Upload new one first.');
        // }

        // UNLINK FILE FROM FOLDER
        $filePath = FCPATH. $image['image_path'];
        if (is_file($filePath)) {
            unlink($filePath);
        }

        // Delete from DB
        $imageModel->delete($imageId);

        return redirect()->back()->with('success', 'Image deleted')->withInput();
    }


    /**
     * Delete Product and All Images of that Product
     */
    public function delete($id)
    {
        $productModel = new \App\Models\ProductModel();
        $imageModel = new  \App\Models\ProductImagesModel();

        //Check ownership
        $product = $productModel->where('id', $id)->where('user_id', auth()->id())->first();
        if (!$product) {
            return redirect()->to('/products/my-listings')->with('error', 'Not allowed');
        }

        // Get all images for this product
        $images = $imageModel->where('product_id', $id)->findAll();

        // Start transaction
        $db = \Config\Database::connect();
        $db->transStart();

        // Delete product with delete Images FK set to CASCADE in DB, so images will be deleted automatically
        $productModel->delete($id);

        // Delete image files from server
        foreach ($images as $img) {
            $filePath = FCPATH. $img['image_path'];
            if (is_file($filePath)) {
                unlink($filePath);
            }
        }

        // Delete image records from DB
        $imageModel->where('product_id', $id)->delete();

        // Complete transaction
        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Failed to delete listing.');
        }

        return redirect()->to('/products/my-listings')->with('success', 'Listing deleted successfully.');
    }


}
