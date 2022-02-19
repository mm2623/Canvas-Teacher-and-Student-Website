<?php require_once "nav.php"; ?>
    <div class="container-contact">
		<h1 class="header-contact">Contact Us</h1>
    <p><u>Sidd Plaza, 500 Rt 33 W Suite LLA, Millstone, New Jersey 08535, United States</u></p>
    <form method="mailto:abdul.mannan12@outlook.com" >

      <label for="name">*Name</label>
      <input type="text" id="name" name="name" placeholder="Your name...">

      <label for="name">Phone</label>
      <input type="text" id="phone" name="Phone" placeholder="Your phone...">

      <label for="email">*Email</label>
      <input type="text" id="email" name="email" placeholder="Your Email Address...">

      <label for="message">*Message</label>
      <textarea id="subject" name="message" placeholder="Your Message..." style="height:144px"></textarea>
      <label for="message-check">1000 characters remaining</label>

      <input type="submit" value="Submit">

    </form> 
	</div>
<?php require_once "footer.php"; ?>