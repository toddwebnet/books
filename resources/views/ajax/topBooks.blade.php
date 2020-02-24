<h1>Top Editions</h1>
<table class="table table-bordered">
    <thead>
    <tr class="active">
        <th scope="col">&nbsp;</th>
        <th scope="col">Title</th>
        <th scope="col">Author</th>
        <th scope="col">Total Available</th>
        <th scope="col">Total Sold</th>
        <th scope="col">SKU</th>
        <th scope="col">Price</th>
        <th scope="col">&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    @foreach($topBooks as $book)
        <tr class="active">

            <td><a class="btn btn-success"
                        href="JavaScript:showBook({{ $book->book_id }})"
                >Show</a></td>
            <td>{{$book->title}}</td>
            <td>{{$book->first_name}} {{$book->last_name}}</td>
            <td>{{number_format($book->totalAvailable, 0) }}</td>
            <td>{{number_format($book->totalSold. 0)}}</td>
            <td>{{$book->sku}}</td>
            <td>${{number_format($book->price, 2)}}</td>
            <td style="text-align:right"
                    class="nobr"
            >
                <a class="btn btn-primary"
                        href="Javascript:editBook({{$book->book_id}})"
                >Edit</a>
                &nbsp;
                <a class="btn btn-warning"
                        href="Javascript:deleteBook({{$book->book_id}})"
                >Delete</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
