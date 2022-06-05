@extends('layouts.admin.app')

@section('script')
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/jquery.ui.touch-punch.min.js"></script>
    <script src="/js/nicEdit.js"></script>
@endsection

@section('title')
    Редактор страниц
@endsection

@section('content')
    <div class="container">
        <script src="/js/nicEdit.js" type="text/javascript"></script>
        <script type="text/javascript">
            function HTMLDecode(text) {
                var temp = document.createElement("div");
                temp.innerHTML = text;
                var output = temp.innerText || temp.textContent;
                temp = null;
                return output;
            }
            bkLib.onDomLoaded(function() {
                new nicEditor({fullPanel : true}).panelInstance('area2');
                nicEditors.findEditor('area2').setContent(HTMLDecode('{{$page->code}}'));
            });
        </script>
        <button class="btn btn-dark btn-save-page my-2" id="{{$page->id}}">Сохранить</button>

        <textarea cols="100" id="area2" style="width: 100%;"></textarea>
    </div>
    <script src="/js/app.js"></script>
@endsection
