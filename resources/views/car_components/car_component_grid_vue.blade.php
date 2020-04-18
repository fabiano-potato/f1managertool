@extends('layouts.app')

@section('content')
    <div id="app">
        <car-component-groups></car-component-groups>
    </div>
@endsection

@section('footer_scripts')
    <script>
        new Vue({
            el: '#app',
            data: function(){
                return {
                }
            }
        })
    </script>
@endsection
