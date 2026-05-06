# Category & Product Management API

A Laravel REST API for managing categories and products with Cloudinary image upload functionality.

## Features

- **Category Management**: Create, read, update, and delete categories
- **Product Management**: Full CRUD operations for products
- **Cloudinary Integration**: Upload and delete images using Cloudinary cloud storage
- **API Testing**: Bruno collection for comprehensive API testing
- **Database**: SQLite database with migrations and seeders

## Tech Stack

- **Backend**: Laravel 11
- **Database**: SQLite
- **Image Storage**: Cloudinary
- **API Testing**: Bruno
- **Authentication**: Laravel Sanctum (ready for implementation)

## Cloudinary Integration

This application uses Cloudinary for image storage and management. Images are uploaded to Cloudinary when creating or updating products, and automatically deleted when products are removed.

### Cloudinary Configuration

Add the following environment variables to your `.env` file:

```env
CLOUDINARY_CLOUD_NAME=your_cloud_name
CLOUDINARY_KEY=your_api_key
CLOUDINARY_SECRET=your_api_secret
```

### Image Upload Features

- **Automatic Upload**: Images are uploaded to specified folders (e.g., `products`)
- **SSL Bypass**: Configured to work in development environments with SSL verification disabled
- **Automatic Deletion**: Images are automatically deleted from Cloudinary when products are deleted
- **Public ID Extraction**: Smart extraction of Cloudinary public IDs from URLs for deletion

## API Endpoints

### Categories

- `GET /api/categories` - List all categories
- `POST /api/categories` - Create a new category
- `GET /api/categories/{id}` - Get specific category
- `PUT /api/categories/{id}` - Update category
- `DELETE /api/categories/{id}` - Delete category

### Products

- `GET /api/products` - List all products
- `POST /api/products` - Create a new product (with image upload)
- `GET /api/products/{id}` - Get specific product
- `PUT /api/products/{id}` - Update product (with image replacement)
- `DELETE /api/products/{id}` - Delete product (with image deletion)

## API Testing with Bruno

This project includes a comprehensive Bruno collection for API testing located in the `bruno/` directory:

```
bruno/
├── Categories_Products/
│   ├── Category/
│   │   ├── Create Category.bru
│   │   ├── Delete Category.bru
│   │   ├── Get All Categories.bru
│   │   ├── Get Category.bru
│   │   └── Update Category.bru
│   └── Product/
│       ├── Create Product.bru
│       ├── Delete Product.bru
│       ├── Get All Products.bru
│       ├── Get Product.bru
│       └── Update Product.bru
└── opencollection.yml
```

### Using Bruno Collections

1. Install [Bruno](https://www.usebruno.com/)
2. Open the Bruno application
3. Import the collection from the `bruno/Categories_Products/` directory
4. Update environment variables in Bruno if needed
5. Run the API tests

### Test Features

- **Complete CRUD Coverage**: All endpoints tested
- **Image Upload Testing**: Includes file upload scenarios
- **Error Handling**: Tests for validation and error responses
- **Authentication Ready**: Structure supports future auth implementation

## Installation & Setup

1. **Clone the repository**

    ```bash
    git clone <repository-url>
    cd category-product-test
    ```

2. **Install dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Environment setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Configure Cloudinary**
   Add your Cloudinary credentials to the `.env` file:

    ```env
    CLOUDINARY_CLOUD_NAME=your_cloud_name
    CLOUDINARY_KEY=your_api_key
    CLOUDINARY_SECRET=your_api_secret
    ```

5. **Database setup**

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

6. **Start the development server**
    ```bash
    php artisan serve
    ```

## Database Schema

### Categories

- `id` - Primary key
- `name` - Category name
- `description` - Category description
- `created_at`, `updated_at` - Timestamps

### Products

- `id` - Primary key
- `category_id` - Foreign key to categories
- `name` - Product name
- `description` - Product description
- `price` - Product price
- `image_url` - Cloudinary image URL
- `created_at`, `updated_at` - Timestamps

## Image Upload Service

The `CloudinaryFileUploadService` handles all Cloudinary operations:

### Key Methods

- `upload(UploadedFile $file, string $folder)` - Upload images to specified folder
- `delete(string $url)` - Delete images by extracting public ID from URL

### Features

- **SSL Verification Bypass**: Configured for development environments
- **Folder Organization**: Images organized by type (products, etc.)
- **Error Handling**: Comprehensive exception handling with descriptive messages
- **Public ID Extraction**: Smart parsing of Cloudinary URLs for deletion

## Development Notes

- The application uses SQLite for development (configurable)
- Images are stored in Cloudinary, not locally
- SSL verification is disabled for Cloudinary API calls (development setup)
- Bruno collections provide comprehensive API testing capabilities
- Ready for authentication implementation with Laravel Sanctum

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test with Bruno collections
5. Submit a pull request

## License

This project is open-sourced software licensed under the MIT license.
