@extends('layout.master')

@section('title', 'Các biểu mẫu')

@section('content')
    <div class="recent-grid grid-col-50">
        <div class="meeting-schedule">
            <div class="card">
                <div class="card-header">
                    <h3>Danh sách biểu mẫu</h3>
                </div>
                <div class="card">
                    <table>
                        <tr>
                            <td><a href="./dist/document/mau-dang-ky-phong-hop.doc">Biểu mẫu đăng ký phòng họp</a></td>
                        </tr>
                        <tr>
                            <td><a href="./dist/document/mau-bien-ban-cuoc-hop-cong-ty.doc">Biểu mẫu biên bản cuộc họp</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#document').addClass('active');
    </script>
@endsection