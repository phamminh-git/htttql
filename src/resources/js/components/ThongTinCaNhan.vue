<template>
    <div id="quanlynhanvien">
        <div id="profile">
            <h3>Thông tin cá nhân</h3>
            <img :src="nhanvien.avatar" class="rounded" alt="...">
            <table class="table float-left rounded" >
                <tr>
                    <th>Tên nhân viên</th>
                    <td>{{nhanvien.ten}}</td>
                </tr>
                <tr>
                    <th>Ngày sinh</th>
                    <td>{{nhanvien.ngaySinh}}</td>
                </tr>
                <tr>
                    <th>Địa chỉ</th>
                    <td>{{nhanvien.diaChi}}</td>
                </tr>
                <tr>
                    <th>Số điện thoại</th>
                    <td>{{nhanvien.sdt}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{nhanvien.email}}</td>
                </tr>
                <tr>
                    <th>Phòng</th>
                    <td>{{nhanvien.phongban.ten}}</td>
                </tr>
                <tr>
                    <th>Vị trí</th>
                    <td>{{nhanvien.vaiTro}}</td>
                </tr>
                <tr>
                    <th>Lương</th>
                    <td>{{nhanvien.hopdongs[0].luong.mucluong}}</td>
                </tr>
                <tr>
                    <th>Ngày ký hợp đồng</th>
                    <td>{{nhanvien.hopdongs[0].ngayKy}}</td>
                </tr>
                <tr>
                    <th>Ngày hết hạn hợp đồng</th>
                    <td>{{nhanvien.hopdongs[0].ngayHetHan}}</td>
                </tr>
                <tr>
                    <th>Danh sach phu cap</th>
                    <th>
                        <table>
                            <tr>
                                <th>Ten phu cap</th>
                                <th>Muc phu cap</th>
                            </tr>
                            <tr v-for="(phucap, index) in nhanvien.hopdongs[0].phucaps" :key="index">
                                <td>{{phucap.ten}}</td>
                                <td>{{phucap.pivot.mucphucap}}</td>
                            </tr>
                        </table>
                    </th>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
import network from '../core/network'
export default {
    data(){
        return {
            nhanvien: window.nhanvien
        }
    },
    methods:{

    },
    mounted(){
        console.log(nhanvien);
    }
}
</script>

<style scoped>
    img{
        height: 200px;
        width: 200px;
    }
</style>