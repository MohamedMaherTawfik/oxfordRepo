<?php

namespace Database\Seeders;

use App\Models\lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class lessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lessons = [
            [
                'title' => 'Introduction to Laravel',
                'description' => 'Learn the basics of Laravel, a powerful PHP framework.',
                'video_url' => 'laravel_intro.mp4',
                'courses_id' => 1,
                'image' => 'laravel_intro.jpg',
                'user_id' => 1,
                'slug' => 'introduction-to-laravel',
            ],
            [
                'title' => 'Routing in Laravel',
                'description' => 'Understand how routing works in Laravel applications.',
                'video_url' => 'laravel_routing.mp4',
                'courses_id' => 1,
                'image' => 'laravel_routing.jpg',
                'user_id' => 1,
                'slug' => 'routing-in-laravel',
            ],
            [
                'title' => 'Laravel Blade Templating',
                'description' => 'Master the Blade templating engine in Laravel.',
                'video_url' => 'laravel_blade.mp4',
                'courses_id' => 1,
                'image' => 'laravel_blade.jpg',
                'user_id' => 1,
                'slug' => 'laravel-blade-templating',
            ],
            [
                'title' => 'Laravel Middleware',
                'description' => 'Learn how to use middleware in Laravel for request filtering.',
                'video_url' => 'laravel_middleware.mp4',
                'courses_id' => 1,
                'image' => 'laravel_middleware.jpg',
                'user_id' => 1,
                'slug' => 'laravel-middleware',
            ],
            [
                'title' => 'Laravel Authentication',
                'description' => 'Implement authentication in Laravel applications.',
                'video_url' => 'laravel_auth.mp4',
                'courses_id' => 1,
                'image' => 'laravel_auth.jpg',
                'user_id' => 1,
                'slug' => 'laravel-authentication',
            ],
            [
                'title' => 'Eloquent ORM Basics',
                'description' => 'Learn how to use Eloquent ORM for database interactions.',
                'video_url' => 'eloquent_basics.mp4',
                'courses_id' => 1,
                'image' => 'eloquent_basics.jpg',
                'user_id' => 1,
                'slug' => 'eloquent-orm-basics',
            ],
            [
                'title' => 'Advanced JavaScript Concepts',
                'description' => 'Deep dive into advanced JavaScript concepts and techniques.',
                'video_url' => 'javascript_advanced.mp4',
                'courses_id' => 2,
                'image' => 'javascript_advanced.jpg',
                'user_id' => 1,
                'slug' => 'advanced-javascript-concepts',
            ],
            [
                'title' => 'Asynchronous JavaScript',
                'description' => 'Learn about callbacks, promises, and async/await in JavaScript.',
                'video_url' => 'async_javascript.mp4',
                'courses_id' => 2,
                'image' => 'async_javascript.jpg',
                'user_id' => 1,
                'slug' => 'asynchronous-javascript',
            ],
            [
                'title' => 'Python Data Analysis with Pandas',
                'description' => 'Explore data analysis using the Pandas library in Python.',
                'video_url' => 'pandas_data_analysis.mp4',
                'courses_id' => 3,
                'image' => 'pandas_data_analysis.jpg',
                'user_id' => 1,
                'slug' => 'python-data-analysis-with-pandas',
            ],
            [
                'title' => 'Python Web Scraping with BeautifulSoup',
                'description' => 'Learn how to scrape web data using BeautifulSoup in Python.',
                'video_url' => 'web_scraping_beautifulsoup.mp4',
                'courses_id' => 3,
                'image' => 'web_scraping_beautifulsoup.jpg',
                'user_id' => 1,
                'slug' => 'python-web-scraping-with-beautifulsoup',
            ],
            [
                'title' => 'Introduction to Machine Learning with Python',
                'description' => 'Get started with machine learning concepts and algorithms using Python.',
                'video_url' => 'ml_intro_python.mp4',
                'courses_id' => 3,
                'image' => 'ml_intro_python.jpg',
                'user_id' => 1,
                'slug' => 'introduction-to-machine-learning-with-python',
            ],
            [
                'title' => 'Data Visualization with Matplotlib',
                'description' => 'Learn how to create visualizations using Matplotlib in Python.',
                'video_url' => 'data_visualization_matplotlib.mp4',
                'courses_id' => 3,
                'image' => 'data_visualization_matplotlib.jpg',
                'user_id' => 1,
                'slug' => 'data-visualization-with-matplotlib',
            ],
            [
                'title' => 'Django Web Development Basics',
                'description' => 'Introduction to web development using the Django framework.',
                'video_url' => 'django_basics.mp4',
                'courses_id' => 3,
                'image' => 'django_basics.jpg',
                'user_id' => 1,
                'slug' => 'django-web-development-basics',
            ],
            [
                'title' => 'Django REST Framework',
                'description' => 'Learn how to build RESTful APIs using Django REST Framework.',
                'video_url' => 'django_rest_framework.mp4',
                'courses_id' => 3,
                'image' => 'django_rest_framework.jpg',
                'user_id' => 1,
                'slug' => 'django-rest-framework',
            ],
            [
                'title' => 'Introduction to React',
                'description' => 'Get started with React, a popular JavaScript library for building user interfaces.',
                'video_url' => 'react_intro.mp4',
                'courses_id' => 4,
                'image' => 'react_intro.jpg',
                'user_id' => 1,
                'slug' => 'introduction-to-react',
            ],
            [
                'title' => 'State Management in React with Redux',
                'description' => 'Learn how to manage state in React applications using Redux.',
                'video_url' => 'react_redux.mp4',
                'courses_id' => 4,
                'image' => 'react_redux.jpg',
                'user_id' => 1,
                'slug' => 'state-management-in-react-with-redux',
            ],
            [
                'title' => 'Building RESTful APIs with Node.js',
                'description' => 'Learn how to create RESTful APIs using Node.js and Express.',
                'video_url' => 'nodejs_rest_api.mp4',
                'courses_id' => 4,
                'image' => 'nodejs_rest_api.jpg',
                'user_id' => 1,
                'slug' => 'building-restful-apis-with-nodejs',
            ],
            [
                'title' => 'Node.js and MongoDB Integration',
                'description' => 'Understand how to integrate Node.js applications with MongoDB.',
                'video_url' => 'nodejs_mongodb.mp4',
                'courses_id' => 3,
                'image' => 'nodejs_mongodb.jpg',
                'user_id' => 1,
                'slug' => 'nodejs-and-mongodb-integration',
            ],
            [
                'title' => 'Introduction to Vue.js',
                'description' => 'Get started with Vue.js, a progressive JavaScript framework.',
                'video_url' => 'vuejs_intro.mp4',
                'courses_id' => 2,
                'image' => 'vuejs_intro.jpg',
                'user_id' => 1,
                'slug' => 'introduction-to-vuejs',
            ],
            [
                'title' => 'Vue.js Component Basics',
                'description' => 'Learn about components in Vue.js and how to use them effectively.',
                'video_url' => 'vuejs_components.mp4',
                'courses_id' => 1,
                'image' => 'vuejs_components.jpg',
                'user_id' => 1,
                'slug' => 'vuejs-component-basics',
            ],
        ];

        foreach ($lessons as $lesson) {
            lesson::create($lesson);
        }
    }
}
