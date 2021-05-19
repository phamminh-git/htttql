@extends('layouts.app')
<script type="application/javascript">
    var nhanvien=JSON.parse('@json($nhanvien)');
</script>
@section('title')
    {{$nhanvien->vaiTro}}
@endsection
@section('content')
<trangchunv-component></trangchunv-component>
@endsection
