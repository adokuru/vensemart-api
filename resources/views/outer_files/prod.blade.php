<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form id="form">
    <input type="file" id="file"></input>
    <button type="submit">Upload file</button>
</form>

<script>

    /* Sending a file appended to a FormData object */

const form = document.getElementById('form');

form.addEventListener('submit', function(event) {
  // Prevent default HTML page refresh
  event.preventDefault();

  // Select file upload element
  const uploadElement = document.getElementById('file');

  // Extract the file (for a single file, always 0 in the list)
  const file = uploadElement.files[0];

  // Create new formData object then append file
  const payload = new FormData();
  payload.append('CV', file, 'CV.pdf');

  // POST/PUT with Fetch API
  fetch('https://httpbin.org/post', {
    method: "POST", // or "PUT"
    body: payload,
    // No content-type! With FormData obect, Fetch API sets this automatically.
    // Doing so manually can lead to an error
  })
  .then(res => res.json())
  .then(data => console.log(data))
  .catch(err => console.log(err))
});

</script>
</body>
</html>