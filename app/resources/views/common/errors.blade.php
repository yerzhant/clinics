@if(count($errors))
        <section class="w3-padding">
            <section class="w3-container w3-leftbar w3-border-red w3-sand">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </section>
        </section>
@endif
