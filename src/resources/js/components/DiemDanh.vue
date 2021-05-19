<template>
    <div>
        <table class="table table-striped">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Ten nhan vien</th>
                    <th scope="col">Ngày sinh</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phòng</th>
                    <th scope="col">Vị trí</th>
                    <th scope="col">#</th>
                </tr>
                <tr v-for="(nhanvien, index) in nhanviens" :key="index">
                    <th scope="row">{{index + 1}}</th>
                    <td >{{nhanvien.ten}}</td>
                    <td>{{nhanvien.ngaySinh}}</td>
                    <td>{{nhanvien.diaChi}}</td>
                    <td>{{nhanvien.email}}</td>
                    <td>{{nhanvien.phongban.ten}}</td>
                    <td>{{nhanvien.vaiTro}}</td>
                    <td><input type="checkbox" name="idnhanvien" id="" v-model="indexNhanVien" :value="index"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button @click.prevent="postNhanVien()">Điểm danh</button></td>
                </tr>
            </table>

    </div>
</template>

<script>
import network from '../core/network'
export default {
    data(){
        return{
            nhanviens: [],
            idnhanviens: new Array(),
            indexNhanVien: [],
            idnhanvien: {}
        }
    },
    methods:{
        getNhanViens(){
            network.get('ngaycong/diemdanh')
            .then(nhanviens=>{
                this.nhanviens=nhanviens;
            })
            .catch(errors=>{
                console.log(errors);
            })
        },
        postNhanVien(){
            for(let i=0; i<this.indexNhanVien.length; i++){
                this.idnhanviens.push((this.nhanviens[this.indexNhanVien[i]-i]).id);
                this.nhanviens.splice(this.indexNhanVien[i]-i, 1);
            }
            this.idnhanvien.idnhanvien=this.idnhanviens;
            network.post('ngaycong/diemdanh', this.idnhanvien)
            .then(message=>{
                console.log(message);
            });
        }
    },
    mounted(){
        this.getNhanViens();
    }
}
</script>

<style scoped>

</style>