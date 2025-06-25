<div id="snackbar" class="snackbar bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
  <p class="font-bold">{{ $title }}</p>
  <p>{{ $message }}</p>
</div>
<script>
let snackbar= document.getElementById('snackbar');
snackbar.className += " show";
      setTimeout(function () {
        snackbar.className = x.className.replace("show", "");
      }, 4000);
</script>