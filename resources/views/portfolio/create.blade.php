<h1>Create Projects</h1>

<form action="/admin/projects" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Title">
    <textarea name="description" placeholder="Description"></textarea>
    <button type="submit">Save</button>
</form>
