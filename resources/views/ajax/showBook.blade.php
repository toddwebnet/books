
<a class="pull-right btn btn-success" href="JavaScript:loadTopBooks()">Back</a>
<h2>{{ $book->title }}</h2>


<div class="row">
    <div class="col-md-1"
            style="text-align:left"
    ></div>
    <div class="col-md-2"
            style="text-align:left"
    >
        <div><b>Book ID: </b> {{ $book->id }}</div>
        <div><b>Author: </b> {{ $book->author->first_name }} {{ $book->author->last_name }}</div>
        <div><b>Copyright: </b> {{ $book->copyright }}</div>
        <div><b>Qty Available: </b> {{ number_format($book->qtyAvailable(),0) }}</div>
        <div><b>Total Sales: </b> ${{ number_format($sales[0],2) }}</div>
    </div>
    <div class="col-md-9">
        <div style="text-align:left">{{ $book->description }}</div>
    </div>
</div>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6"
            style="padding-bottom: 10px;margin-bottom: 10px;border: 1px solid #ccc"
    >
        <form id="thisFineForm">
            {{ csrf_field() }}

            <b>Please Fill out your name information before purchasing</b><BR/>
            <label for="firstName">First Name</label>
            <input type="text"
                    name="firstName"
                    id="firstName"
                    placeholder="First Name"
            >

            <label for="lastName">Last Name</label>
            <input type="text"
                    name="lastName"
                    id="lastName"
                    placeholder="Last Name"
            >
        </form>

    </div>
    <div class="col-md-3"></div>
</div>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <table class="table table-bordered">


            @foreach($book->editions as $edition)
                <tr>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Print Date</th>
                    <th>Qty Available</th>
                    <th>Sales</th>
                    <th>&nbsp;</th>
                </tr>

                <tr>
                    <td>{{$edition->sku}}</td>
                    <td>${{number_format( $edition->price,2)}}</td>
                    <td>{{$edition->print_date}}</td>
                    <td>{{number_format($edition->qty_available,0)}}</td>
                    <td>${{number_format($sales[$edition->id],2)}}</td>
                    <td style="text-align:right"><a class="btn btn-primary"
                                href="JavaScript:purchaseBook({{$edition->id}})"
                        >Purchase One</a></td>
                </tr>
                @foreach($edition->sales as $sale)
                    <tr>
                        <td colspan="6">
                            <a style="float:right"
                                    href="JavaScript:deleteSale({{ $sale->id }})"
                            >Delete</a>
                            <b>Sale to: </b>{{$sale->customer_first_name}} {{$sale->customer_last_name}}
                            on {{ $sale->sale_date }} for ${{ number_format($sale->price, 2) }}
                        </td>
                    </tr>
                @endforeach
            @endforeach

        </table>
    </div>
    <div class="col-md-1"></div>
</div>
