<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed 5 Realistic Categories with Tailwind badge colors
        $categoriesData = [
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'color' => 'blue',
            ],
            [
                'name' => 'UI & UX Design',
                'slug' => 'ui-ux-design',
                'color' => 'purple',
            ],
            [
                'name' => 'DevOps & Cloud',
                'slug' => 'devops-cloud',
                'color' => 'emerald',
            ],
            [
                'name' => 'Artificial Intelligence',
                'slug' => 'artificial-intelligence',
                'color' => 'amber',
            ],
            [
                'name' => 'Cybersecurity',
                'slug' => 'cybersecurity',
                'color' => 'rose',
            ],
        ];

        $categories = collect($categoriesData)->map(function ($cat) {
            return Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        });

        // 2. Seed 5 Distinct Authors/Users
        $primaryUser = User::firstOrCreate(
            ['email' => 'alex@example.com'],
            [
                'name' => 'Alex Morgan',
                'username' => 'alexmorgan',
                'avatar' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=alexmorgan',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]
        );

        $demoUsersData = [
            [
                'name' => 'Sarah Connor',
                'username' => 'sarahconnor',
                'email' => 'sarah@example.com',
                'avatar' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=sarahconnor',
            ],
            [
                'name' => 'David Miller',
                'username' => 'davidmiller',
                'email' => 'david@example.com',
                'avatar' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=davidmiller',
            ],
            [
                'name' => 'Elena Rostova',
                'username' => 'elenarostova',
                'email' => 'elena@example.com',
                'avatar' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=elenarostova',
            ],
            [
                'name' => 'Marcus Chen',
                'username' => 'marcuschen',
                'email' => 'marcus@example.com',
                'avatar' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=marcuschen',
            ],
        ];

        $otherUsers = collect($demoUsersData)->map(function ($userData) {
            return User::firstOrCreate(
                ['email' => $userData['email']],
                array_merge($userData, [
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                    'remember_token' => Str::random(10),
                ])
            );
        });

        $allUsers = collect([$primaryUser])->merge($otherUsers);

        // 3. Realistic Titles for 50 Blog Posts
        $sampleTitles = [
            'Building Scalable Modern Web Applications with Laravel 11',
            'Mastering Tailwind CSS: From Zero to Utility-First Hero',
            'The Comprehensive Guide to Reactive Blade with Alpine.js',
            'Demystifying N+1 Query Problems in Modern Eloquent ORMs',
            'Designing Accessible and Beautiful User Interfaces in 2026',
            'Microservices vs Modular Monolith: Which Architecture to Pick?',
            'Securing Authentication in Distributed REST and GraphQL APIs',
            'Why SQLite is the Secret Weapon for Modern Web Projects',
            'Containerizing Full-Stack PHP and Node Workflows with Docker',
            'Deploying Laravel Apps seamlessly to Fly.io and AWS ECS',
            'Optimizing Database Indexing for High-Throughput Read Systems',
            'Exploring Generative AI APIs in Everyday Web Applications',
            'Clean Architecture Principles in Large Laravel Codebases',
            'Component-Driven Development: Goodbye Traditional Layout Inheritance',
            'Building Real-Time Notifications using WebSockets and Reverb',
            'Automated Testing with Pest PHP: Writing Elegant Feature Tests',
            'Defending Web Apps Against Modern CSRF and XSS Attacks',
            'Crafting Dark Mode Experiences that Feel Truly Native',
            'Zero Downtime Deployment Pipelines with GitHub Actions',
            'The Art of Database Migrations in Collaborative Dev Teams',
            'Advanced Alpine.js State Management without Heavy Bundlers',
            'Mastering Eloquent Scopes: Creating Expressive Filter Engines',
            'Handling File Uploads Cleanly with Storage Disks and S3',
            'Building Interactive Search Bars with URL State Preservation',
            'Why Component Slots and Props Beat Traditional Blade Sections',
            'Exploring Edge Computing and Serverless PHP Functions',
            'Best Practices for API Rate Limiting and Token Management',
            'Understanding Typography Scales for Content-Heavy Blogs',
            'Building Reusable Form Controls with Validation Error Badges',
            'Event-Driven Systems in Laravel: Observers, Events, and Queues',
            'Performance Tuning Laravel: Caching Strategies That Actually Work',
            'Creating Resilient Search Filters with Dynamic Query Strings',
            'Essential Git Workflow for Fast-Moving Software Teams',
            'Modern CSS Grid and Flexbox Tricks You Probably Never Knew',
            'How to Build Intuitive Dashboard CRUD Experiences',
            'Designing Confirmation Modals with Alpine.js Transitions',
            'Handling Real-Time Slug Generation in Author Forms',
            'Database Seeding Best Practices: Generating Believable Test Data',
            'Preventing Insecure Direct Object References with Route Policies',
            'A Deep Dive into Laravel Route Model Binding Customization',
            'Streamlining Assets Compilation with Vite and PostCSS',
            'Understanding PHP 8.2 & 8.3 Features Every Developer Should Use',
            'Designing Zero-Clutter Navigation Bars for Mobile and Desktop',
            'The Power of First-Party Laravel Packages: Breeze vs Jetstream',
            'Building Custom Blade Anonymous Components with Attribute Bag Magic',
            'Writing Self-Documenting Code with Expressive Eloquent Relationships',
            'Securing User File Uploads: Mime Validation and Sanitization',
            'The Future of Full-Stack Web Development in the Age of AI',
            'Continuous Integration Strategies for Solo Full-Stack Developers',
            'From Prototype to Production: A Complete Launch Checklist',
        ];

        // Seed 50 posts distributed across 5 users and 5 categories
        foreach ($sampleTitles as $index => $title) {
            $user = $allUsers->get($index % $allUsers->count());
            $category = $categories->get($index % $categories->count());

            Post::create([
                'title' => $title,
                'slug' => Str::slug($title) . '-' . ($index + 1),
                'author_id' => $user->id,
                'category_id' => $category->id,
                'body' => $this->generateSampleBody($title, $category->name),
                'image' => null,
                'created_at' => now()->subDays(50 - $index)->subHours(rand(1, 12)),
                'updated_at' => now()->subDays(50 - $index),
            ]);
        }
    }

    private function generateSampleBody(string $title, string $category): string
    {
        return "Welcome to our comprehensive article exploring **{$title}**.\n\n"
            . "In this article within the **{$category}** domain, we will take a detailed look into the core principles, architecture, and practical implementations needed to excel in modern software engineering.\n\n"
            . "### 1. Key Insights & Architecture\n"
            . "When building applications at scale, adhering to modular component design and clean architecture is essential. By separating concerns between data models, business policies, and component-driven view layers, developer productivity and system reliability increase significantly.\n\n"
            . "### 2. Practical Implementation\n"
            . "Writing clean code is not just about functionality; it's about clarity and maintainability for teams. Ensuring that database relationships are eager-loaded, queries are indexed, and interactive components are lightweight provides the best experience for end users.\n\n"
            . "### 3. Conclusion & Takeaways\n"
            . "Embracing component-driven paradigms, proper authorization policies, and reactive client-side micro-interactions helps build resilient applications that stand the test of time.";
    }
}
