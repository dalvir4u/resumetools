<?php

// Echo the image - timestamp appended to prevent caching
echo '<img src="images/image.php?' . time() . '" width="132" height="46" alt="Captcha image" />';

?>