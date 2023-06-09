<form action="/submit" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Name">
    <input type="file" name="profile_picture" placeholder="Profile Picture">
    <button type="submit">Submit</button>
</form>


