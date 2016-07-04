@extends('layouts.master')

@section('title')
Contact Us
@endsection


@section('content')
    @if(!Auth::user())
    <div class="content contact">

        <div class="info">
            <h4>Phone</h4>

            <!-- <h5>Oklahoma City</h5>-->
            <h6>(405) 285-1522</h6>

            <!--
            <h5>Tulsa</h5>
            <h6>(918) 399-1028</h6>
            -->

            <h4>Email</h4>
            <h5>DEA Inquiries</h5>
            <h6><a href="mailto:khan@gmail.com">khan@gmail.com</a></h6>

            <h5>DEG Inquiries</h5>
            <h6><a href="mailto:anup@gmail.com">anup@gmail.com</a></h6>

            <h5>Event Inquiries</h5>
            <h6><a href="mailto:cycling@gmail.com<">cycling@gmail.com</a></h6>


        </div>


        <form action="/contact" method="post">

            <h4>Send us some electronic mail</h4>


            <p>
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name">
            </p>

            <p>
                <label for="email">Email Address:</label>
                <input type="text" id="email" name="email">
            </p>

            <p>
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone">
            </p>

            <p>
                <label for="location">Location (city):</label>
                <input type="text" id="location" name="location">
            </p>

            <p>
                <label for="message">Message:</label>
                <textarea rows="10" name="message"></textarea>
            </p>
            <div class="dots">
                <input class="submit" type="submit" name="submit" value="send">
            </div>
        </form>
    </div>
    @endif

    @if(Auth::user())
        <section>
            <h1>Teams</h1>
            <div class="tbl-header">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Focus</th>
                        <th>email</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div  class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody class="equipment-tbody">
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->focus}}</td>
                            <td>{{$user->email}}</td>
                        </tr>
                    @endforeach


                </tbody>
                </table>
            </div>
        </section>
    @endif



@endsection

