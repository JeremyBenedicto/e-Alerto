<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Scroll Button</title>
<style>
.scroll-button {
  position: fixed;
  bottom: 20px;
  right: 20px;
  width: 50px;
  height: 50px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 50%;
  cursor: pointer;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.scroll-button.show {
  display: block;
}
</style>
</head>
<body>

<div class="content">
  <!-- Your content goes here -->
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus lobortis eros a magna tincidunt, at ultricies sapien finibus. Nulla vehicula erat nec neque hendrerit tempor. Donec varius nunc non nisl feugiat, sed aliquam nunc sodales. Vivamus vel scelerisque ligula. Integer a tortor vitae ligula dictum hendrerit. Aliquam erat volutpat. Vestibulum viverra mauris ac odio pharetra, nec fringilla quam feugiat.</p>
  <p>Nullam nec dolor tincidunt, venenatis libero id, finibus justo. Duis id elit non libero tempus iaculis vel at eros. Nullam scelerisque aliquam sapien, vel aliquam justo vehicula eu. Sed nec massa at odio congue congue nec id ex. Nulla facilisi. Pellentesque porttitor lacus quis tellus varius, vel fermentum leo dapibus. Integer iaculis rhoncus mi, eget congue enim convallis eu. Duis eleifend arcu quis justo auctor dictum.</p>
  <p>Etiam fermentum quam ut nulla faucibus, ut convallis velit tristique. Nam vitae arcu sed orci euismod dignissim. Donec eget vehicula ex, non viverra lacus. Aliquam fermentum nunc ac magna rutrum, et condimentum lectus dignissim. In efficitur metus sit amet urna suscipit, eu ullamcorper ligula ultrices. Proin eu elit lacinia, eleifend turpis sed, rhoncus leo. Phasellus congue eros vel mauris sollicitudin lacinia. Mauris varius risus vel lacus consequat, eget cursus felis hendrerit.</p>
  <p>Vestibulum ac dui eget dolor finibus aliquam. Aliquam non fermentum lacus. Cras fermentum venenatis libero, ut vehicula dui dapibus in. Vivamus ac aliquet dolor. Aenean eget augue id magna iaculis pretium vel id nisi. Nullam quis nisi euismod, dapibus risus at, efficitur est. Morbi auctor magna nec erat dictum, ac molestie ipsum tincidunt. Vivamus ut ex nec risus aliquet malesuada. Nam non mauris at odio efficitur tempus id et lectus.</p>
  <p>Integer nec fermentum lacus. Mauris dictum lacus vel posuere commodo. Nulla lacinia massa a libero dignissim, ut ultrices ligula feugiat. Donec nec velit metus. Nullam eget augue nec nulla convallis dapibus. Vestibulum id eros eros. Morbi fringilla mauris eu sapien maximus, in bibendum justo gravida. Fusce aliquam interdum erat. Suspendisse vestibulum luctus tortor, a dapibus urna laoreet sed.</p>
  <p>Curabitur nec eros sit amet dui efficitur fermentum non sit amet ex. Cras sed nisi at enim scelerisque egestas sit amet sit amet leo. Proin tincidunt luctus nisi vel euismod. Duis accumsan, nulla et scelerisque convallis, leo orci elementum libero, sit amet pharetra urna sapien ut neque. Integer in lacus sit amet nunc gravida vehicula a eget tortor. Vestibulum consectetur, orci in tincidunt feugiat, nulla justo vehicula risus, nec vestibulum felis elit a risus.</p>
</div>

<a href="admin_interface.php" class="scroll-button">Scroll Up</a>

<script>

</script>

</body>
</html>
