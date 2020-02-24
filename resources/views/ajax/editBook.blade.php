<a class="pull-right btn btn-success"
        href="JavaScript:loadTopBooks()"
>Back</a>
<a class="pull-left btn btn-primary"
        href="JavaScript:editBook({{ $book->id }})"
>Refresh</a>

<h2>Edit Book</h2>

<form id="bookForm" onsubmit="return saveBook()">
    {{ csrf_field() }}

    <input type="hidden" name="book_id" value="{{ $book->id }}">
    <div class="form-group">
        <label>Author</label>
        <input type="text"
                class="zform-control"
                id="first_name"
                name="first_name"
                placeholder="First Name"
                value="{{ $book->author->first_name }}"
        />
        <input type="text"
                class="zform-control"
                id="last_name"
                name="last_name"
                placeholder="Last Name"
                value="{{ $book->author->last_name }}"
        />
    </div>
    <div class="form-group">
        <label>Title</label>
        <input type="text"
                class="form-control"
                id="title"
                name="title"
                placeholder="Title"
                value="{{ $book->title }}"
        />
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control"
                id="description"
                name="description"
                placeholder="Description"
                value="{{ $book->description }}"
        >{{$book->description}}</textarea>
    </div>
    <div class="form-group">
        <label>Copyright</label>
        <input type="text"
                class="zform-control"
                id="copyright"
                name="copyright"
                placeholder="Copyright"
                value="{{ $book->copyright }}"
        />
    </div>
    <div class="form-group">
        <input type="submit" class="pull-right btn btn-primary" value="Save Book"/>
    </div>
</form>





