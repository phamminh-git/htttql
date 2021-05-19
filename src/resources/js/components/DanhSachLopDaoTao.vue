<template>
    <div id="lop dao tao">
        <h1>Danh sach lop dao tao</h1>
        <table class="table">
            <tr>
                <th>STT</th>
                <th>Ten lop</th>
                <th>Ngay bat dau</th>
                <th>Mo ta</th>
                <th>#</th>
            </tr>
            <tr v-for="(lopdaotao, index) in lopdaotaos" :key="index">
                <td>{{index+1}}</td>
                <td>{{lopdaotao.ten}}</td>
                <td>{{lopdaotao.ngaybatdau}}</td>
                <td>{{lopdaotao.mota}}</td>
                <td>
                    <a href="" @click.prevent="editLop(index)">Sua</a>
                </td>
            </tr>
        </table>
        <a href="#" @click.prevent="show=!show" v-if="!show">Thêm lớp đào tạo</a>
        <table v-if="show" class="table">
            <tr>
                <td><label for="ten">Nhập tên</label></td>
                <td><input type="text" v-model="lop.ten"></td>
            </tr>
            <tr>
                <td><label for="ngaybatdau">Nhập ngay bat dau</label></td>
                <td><input type="date" v-model="lop.ngaybatdau"></td>
            </tr>
            <tr>
                <td><label for="mota">Nhập mo ta</label></td>
                <td><input type="text" v-model="lop.mota"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
        </table>
        <table  v-if="show" class="table">
            <tr>
                <th>STT</th>
                <th>Ten</th>
                <th>Gioi Tinh</th>
                <th>Dia Chi</th>
                <th>So dien thoai</th>
                <th>Email</th>
                <th>#</th>
            </tr>
            <tr v-for="(nhanvien, index) in nhanviens" :key="index">
                <td>{{index+1}}</td>
                <td>{{nhanvien.ten}}</td>
                <td>{{nhanvien.gioiTinh}}</td>
                <td>{{nhanvien.diaChi}}</td>
                <td>{{nhanvien.sdt}}</td>
                <td>{{nhanvien.email}}</td>
                <td><input type="checkbox" name="idnhanviens[]" v-bind:value="nhanvien.id" v-model="idnhanvien"></td>
            </tr>
        </table> 
        <input type="submit" value="Them" v-if="show" @click.prevent="postLopDaoTao()">
        <button @click="huy" v-if="show">Quay Lai</button>
    </div>
</template>

<script>
import network from '../core/network';
export default {
    data(){
        return{
            lopdaotaos: [],
            idlop: '',
            lop: {},
            nhanviens: [],
            show: false,
            idnhanvien: []
        }
    },
    methods:{
        getLopDaoTaos(){
            network.get('lopdaotao')
            .then(lopdaotaos=>{
                this.lopdaotaos=lopdaotaos;
            })
            .catch(errors=>{
                console.log(errors);
            });
            network.get('nhanvien')
            .then(nhanviens=>{
                this.nhanviens=nhanviens;
            })
            .catch(errors=>{
                console.log(errors);
            });
        },
        editLop(index){
            this.lop=this.lopdaotaos[index];
            network.get('lopdaotao/'.concat(this.lop.id).concat('/getnhanvien'))
            .then(nhanviens=>{
                this.nhanviens=nhanviens;
            });
            this.show=true;
        },
        postLopDaoTao(){
            this.lop.idnhanvien=this.idnhanvien;
            network.post('lopdaotao', this.lop)
            .then(message=>{
                console.log(message);
                this.lopdaotaos.push(message);
            })
            .catch(errors=>{
                console.log(errors);
            });
            this.show=!this.show;
            this.idnhanvien=[];
        },
        addLopDaoTao(){
            this.show=!this.show;           
        },
        huy(){
            this.show=!this.show;
            this.lop={};
        }
    },
    mounted(){
        this.getLopDaoTaos();
    }
}
</script>
<style scoped>

</style>