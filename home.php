<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Tera Microfinance</title>
  <style>
    body {
  font-family: Arial, sans-serif;
  background-color: #f1f1f1;
  margin: 0;
  padding: 0;
}

.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

h1, h2 {
  color: #333;
}

ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

nav ul li {
  display: inline-block;
  margin-right: 10px;
}

nav ul li a {
  text-decoration: none;
  color: #333;
}

section {
  margin-bottom: 20px;
}

.button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #4caf50;
  color: #fff;
  text-decoration: none;
  border-radius: 4px;
}

footer {
  background-color: #333;
  color: #fff;
  padding: 10px;
  text-align: center;
}

  </style>
</head>
<body>
    <?php include_once "dash-nav.php"; ?>
  
  <div class="container">
    <h1>Welcome to Tera Microfinance</h1>
    <p>Providing financial solutions for individuals and businesses</p>
    
    <section>
      <h2>About Us</h2>
      <p>
      Tera Microfinance is a leading financial institution dedicated to providing inclusive financial services to empower individuals and businesses in our community. We believe that access to financial services is a fundamental right, and we are committed to making a positive impact by fostering economic growth and financial inclusion.
    </p>
    <p>
      At Tera Microfinance, we offer a wide range of financial products and services tailored to meet the unique needs of our customers. Whether you are an aspiring entrepreneur, a small business owner, or an individual looking for personal financial solutions, we are here to support you on your financial journey.
    </p>
    <p>
      Our team of experienced professionals is passionate about delivering exceptional customer service and building long-lasting relationships with our clients. We strive to understand your goals and challenges to provide personalized financial solutions that help you achieve financial stability and success.
    </p>
    <p>
      Tera Microfinance is committed to upholding the highest standards of transparency, integrity, and social responsibility. We adhere to regulatory requirements and ethical practices to ensure the trust and confidence of our stakeholders. Our aim is to create sustainable value for our customers, employees, shareholders, and the communities we serve.
    </p>
    <p>
      Thank you for choosing Tera Microfinance. We look forward to being your trusted financial partner and helping you build a better future.
    </p>
    </section>
    
    <section>
      <h2>Services</h2>
      <ul>
        <li>Personal Loans</li>
        <li>Business Loans</li>
        <li>Microfinance Solutions</li>
        <li>Financial Consultancy</li>
      </ul>
    </section>
    
    <section>
      <h2>Apply Now</h2>
      <p>Ready to get started? Apply for a loan now!</p>
      <a href="loan.php" class="button">Apply Now</a>
    </section>
    
    <section>
      <h2>Contact Us</h2>
      <p>Have any questions or need assistance? Get in touch with our support team.</p>
      <a href="contacts.php" class="button">Contact Us</a>
    </section>
  </div>
  
  <footer>
  <p>&copy; <?php echo date("Y"); ?> Tera Microfinance. All rights reserved.</p>
</footer>

</body>
</html>
