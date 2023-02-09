## Lara Blog

Simple blog made with Laravel having CRUD functionality.

Front page is just for show, no actual content there.

<details>
<summary>Home</summary>
<picture>
  <img alt="Home" src="https://raw.githubusercontent.com/jik-SAN/LaraBlog/main/screenshots/Home.png">
</picture>
</details>

In the blog part of website logged in user can create, edit and delete their posts.

Verification email is sent to registered users.

An email is send to user when a new post is created.
<details>
<summary>Blog</summary>
<picture>
  <img alt="Blog" src="https://raw.githubusercontent.com/jik-SAN/LaraBlog/main/screenshots/Blog-posts.png">
</picture>
</details>

All inputs during creation and edit of posts are sanitized and validated.
<details>
<summary>Create Blog Post</summary>
<picture>
  <img alt="create" src="https://raw.githubusercontent.com/jik-SAN/LaraBlog/main/screenshots/Create.png">
</picture>
</details>

<details>
<summary>User Profile</summary>
<picture>
  <img alt="user" src="https://raw.githubusercontent.com/jik-SAN/LaraBlog/main/screenshots/profile.png">
</picture>
</details>

Little bit of alpine.js used for the user dropdown in navigation panel.

No admin functionality yet.

DB hosted on planetscale.com & user image uploads on uploadcare.com

For search query only characters and number are allowed, its a simple db query that searches through both title and content of all blog posts.
<ol>
<p>How to run locally<p>
<li>Clone the repo.</li>
<li>Setup DB and env variables.</li>
<li>php artisan migrate:fresh --seed</li>
<li>composer install --optimize-autoloader --no-dev</li>
<li>php artisan config:cache &&
 php artisan route:cache && 
php artisan view:cache</li>
<li>npm install</li>
<li>npm run build</li>
<li>php artisan serve</li>
</ol>
