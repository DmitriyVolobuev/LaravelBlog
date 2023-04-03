<div class="card-body">

    <div class="d-flex justify-content-between">

        <div class="">

            {{ $slot }}

        </div>

        <div class="">

            @isset($right)

                {{ $right }}

            @endisset

        </div>


    </div>

</div>
