{!!Carbon\Carbon::parse(($data->updated_at))->addMonth($data->product_expiration)->format('d M, Y')!!}