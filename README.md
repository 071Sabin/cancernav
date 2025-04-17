<h1>Cancer Navigation Support System</h1>

<p>
A role-based web platform designed to help underserved cancer patients access social needs services like transport, housing, and financial aid. Built using Laravel, the system supports Admins, Navigators, and Patients with secure access and tailored functionalities.
</p>

<h2>🚀 Features (Overview)</h2>
<ul>
  <li>Patient-to-Navigator and Navigator-to-Admin request flows</li>
  <li>Dashboard summaries with charts and alerts</li>
  <li>Financial aid filtering based on eligibility</li>
  <li>Simulated API integration for services</li>
  <li>Broadcast system for alerts and messages</li>
  <li>Secure file and image handling with access control</li>
  <li>Role-based access for Admins, Navigators, and Patients</li>
</ul>

<hr>

<h2>⚙️ Installation & Setup</h2>
<p>Follow the steps below to run the project locally:</p>

<h3>1. <strong>Clone the Repository</strong></h3>
<pre><code>git clone https://github.com/071Sabin/cancernav.git
cd cancernav
</code></pre>

<h3>2. <strong>Install Dependencies</strong></h3>
<p>Make sure you have PHP >= 8.1, Composer, MySQL, and Node.js installed.</p>

<p><strong>Install backend PHP packages:</strong></p>
<pre><code>composer install</code></pre>

<h3>3. <strong>Environment Setup</strong></h3>
<pre><code>cp .env.example .env</code></pre>

<p>Update the <code>.env</code> file with your database credentials:</p>
<pre><code>DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
</code></pre>

<h3>4. <strong>Run Migrations and Seeders</strong></h3>
<pre><code>php artisan migrate --seed</code></pre>

<h3>5. <strong>Storage Linking (for file access)</strong></h3>
<pre><code>php artisan storage:link</code></pre>

<h3>6. <strong>Start the Server</strong></h3>
<pre><code>php artisan serve</code></pre>

<p>Visit <a href="http://localhost:8000" target="_blank">http://localhost:8000</a> in your browser.</p>

<h4><strong>Default Admin Login</strong></h4>
<pre><code>Email: admin@gmail.com
Password: admin@123
</code></pre>
