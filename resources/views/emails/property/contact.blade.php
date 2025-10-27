

        New Inquiry for {{ $property->title }}


    <p>Hello,</p>

    <p>You have received a new inquiry for the property titled "<strong>{{ $property->title }}</strong>". Below are the details of the inquiry:</p>

    <ul>
        <li><strong>Name:</strong> {{ $inquiry['first_name']  }} {{ $inquiry['last_name']  }}  </li>
        <li><strong>Email:</strong> {{ $inquiry['email'] }}</li>
        <li><strong>Phone:</strong> {{ $inquiry['phone'] }}</li>
        <li><strong>Message:</strong> {{ $inquiry['message'] }}</li>
    </ul>

    <p>Please respond to the inquiry at your earliest convenience.</p>

    <p>Best regards,<br>Your Real Estate Team</p>

