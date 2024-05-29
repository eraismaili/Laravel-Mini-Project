<!DOCTYPE html>
<html>

<head>
    <title>Pay with PayPal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pay with PayPal</div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('paypal.payWithPayPal') }}" method="GET"
                            style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Pay with PayPal</button>
                        </form>
                        <a href="{{ route('profile.show') }}" class="btn btn-secondary"
                            style="display: inline-block;">Go Back to Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
