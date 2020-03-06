
    <div class="container" style="margin-bottom: 15px">
        <div class="clearfix">
        </div>

        <div id="zoznam"> <h2>Zoznam používateľov <small id="zrusit"><a href=""> X</a></small></h2>
            <ul style="column-count: 3;column-rule: 1px solid gray;column-gap: 70px;list-style: none;">
                {{--@forelse($organizations as $user)--}}
                    {{--<li><a href="{{ url($user->slug ) }}">--}}
                                {{--{{ Str::limit($user->first_name, 33) }} <span class="pull-right">{{ $user->posts_count }}</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--@empty--}}
                    {{--Nothing--}}
                {{--@endforelse--}}
            </ul>
        </div>
    </div>



@section('script')

    <script>
        $(document).ready(function(){

            $('#zoznam').hide();

            $('#zobrazit').click(function(){
                $('#zoznam').slideToggle();
            });

            $('#zrusit').click(function(){
                $('#zoznam').slideUp();
            });
        });
    </script>
@endsection

