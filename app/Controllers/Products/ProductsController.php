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

    public function create(){
        $categoriesModel = new \App\Models\CategoriesModel();

        $categories = $categoriesModel->find();

        return view('pages/create', [
            'categories' => $categories
        ]);

    }

    public function details(){

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

    public function show($product_id){
        return view('pages/show-product');
    }


    /**
     * Get User Basic Product Information
     * Validate The Info 
     * Store In a Session
     */
    public function StoreBasicInfo(){
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
        foreach ($images as $image) {

            $newName = $image->getRandomName();

            $image->move($uploadPath, $newName);

            $storedFiles[] = $uploadPath . $newName;

            $imageModel->insert([
                'product_id' => $productId,
                'image_path' => 'uploads/products/' . $newName,
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
        return redirect()->to('/products/listings')
            ->with('success', 'Your product has been posted successfully.');
    }

}
