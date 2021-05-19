<template>
	<div id="quanlynhanvien">
		<div  v-if="!show">
			<div id="title">
				<p>Danh sách nhân viên</p>
				<div>
					<input type="text" name="ten" id="" placeholder="nhap ten nhan vien" v-model="ten.ten">
					<input type="submit" value="Tim kiem" @click.prevent="handleSearch">
				</div>
			</div>
			<table class="table table-striped">
				<tr>
					<th scope="col">STT</th>
					<th scope="col">Ten nhan vien</th>
					<th scope="col">Ngày sinh</th>
					<th scope="col">Địa chỉ</th>
					<th scope="col">Email</th>
					<th scope="col">Phòng</th>
					<th scope="col">Vị trí</th>
					<th scope="col">Trang thai</th>
					<th scope="col">#</th>
				</tr>
				<tr v-for="(nhanvien, index) in nhanviens" :key="index">
					<th scope="row">{{index + 1}}</th>
					<td class="nhanvien" @click.prevent="detailNhanVien(index)">{{nhanvien.ten}}</td>
					<td>{{nhanvien.ngaySinh}}</td>
					<td>{{nhanvien.diaChi}}</td>
					<td>{{nhanvien.email}}</td>
					<td>{{nhanvien.phongban.ten}}</td>
					<td>{{nhanvien.vaiTro}}</td>
					<td>{{check(nhanvien.hopdongs[0].ngayHetHan)}}</td>
					<td><button v-if="check(nhanvien.hopdongs[0].ngayHetHan)=='Đã nghỉ'" @click.prevent="deleteNhanVien(nhanvien.id,index)">Xoa</button>
						<button @click.prevent="editNhanVien(index)">Sửa</button>
					</td>
				</tr>
			</table>
		</div>

		<div id="profile" v-if="show">
			<img :src="nhanvien.avatar" class="rounded float-right" alt="...">
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
					<td>{{tenphong}}</td>
				</tr>
				<tr>
					<th>Vị trí</th>
					<td>{{nhanvien.vaiTro}}</td>
				</tr>
				<tr>
					<th>Lương</th>
					<td>{{luong}}</td>
				</tr>
				<tr>
					<th>Ngày ký hợp đồng</th>
					<td>{{ngayKy}}</td>
				</tr>
				<tr>
					<th>Ngày hết hạn hợp đồng</th>
					<td>{{ngayHetHan}}</td>
				</tr>
			</table>
			<a href="#" @click.prevent="show=!show" v-if="show">Quay lại</a>
		</div>

		<form action="" enctype="multipart/form-data" @submit.prevent="postNhanVien()" v-if="showEdit">
			<table class="table">
				<tr>
					<td><label for="tennhanvien">Nhập nhân viên</label></td>
					<td><input type="text" v-model="nhanvienedit.ten" id="tennhanvien"></td>
				</tr>
				<tr>
					<td><label for="ngaysinh">Nhập ngày sinh</label></td>
					<td><input type="date" v-model="nhanvienedit.ngaySinh" id="ngaysinh"></td>
				</tr>
				<tr>
					<td><label for="gioitinh">Nhập giới tính</label></td>
					<td><input type="radio" v-model="nhanvienedit.gioiTinh" name="gioitinh" value="nam"> Nam
						<input type="radio" v-model="nhanvienedit.gioiTinh" name="gioitinh" value="nu"> Nu
					</td>
				</tr>
				<tr>
					<td><label for="diachi">Nhập địa chỉ</label></td>
					<td><input type="text" v-model="nhanvienedit.diaChi" id="diachi"></td>
				</tr>
				<tr>
					<td><label for="email">Nhập email</label></td>
					<td><input type="email" v-model="nhanvienedit.email" id="email"></td>
				</tr>
				<tr>
					<td><label for="sdt">Nhập số điện thoại</label></td>
					<td><input type="text" v-model="nhanvienedit.sdt" id="sdt"></td>
				</tr>
				<tr>
					<td><button @click.prevent="showEdit=false">Quay lại</button></td>
					<td><input type="submit" value="Cập nhật"></td>
				</tr>
			</table>
		</form>
	</div>
</template>

<script>
import network from '../core/network'
export default {
	data(){
		return {
			nhanviens: [],
			ten: {},
			nhanvien: {},
			tenphong: '',
			luong: '',
			ngayKy: '',
			ngayHetHan: '',
			show: false,
			index: '',
			nhanvienedit: {},
			showEdit: false
		}
	},
	methods:{
		getNhanVien(){
			network.get('nhanvien')
			.then(nhanviens=>{
				this.nhanviens=nhanviens;
			})
			.catch(errors=>{
				console.log(errors);
			});
		},
		handleSearch(){
			network.get('nhanvien/search', this.ten)
			.then(nhanviens=>{
				this.nhanviens=nhanviens;
			})
			.catch(errors=>{
				console.log(errors);
			});
		},
		check(date){
			var s1=new Date(date).getTime();
			var today=new Date();
			var s2=new Date(today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()).getTime();
			if(s1>=s2){
				return 'Đang làm việc';
			}
			else{
				return "Đã nghỉ";
			}
		},
		deleteNhanVien(id,index){
			network.get('nhanvien/'.concat(id).concat('/delete'))
			.then(message=>{
				if(message){  
				}
			});
			this.nhanviens.splice(index);
		},
		detailNhanVien(index){
			this.nhanvien=this.nhanviens[index];
			this.tenphong=this.nhanvien.phongban.ten;
			this.luong=this.nhanvien.hopdongs[0].luong.mucluong;
			this.ngayKy=this.nhanvien.hopdongs[0].ngayKy;
			this.ngayHetHan=this.nhanvien.hopdongs[0].ngayHetHan;
			this.show=true;
		},
		editNhanVien(index){
			this.index=index;
			this.nhanvienedit=JSON.parse(JSON.stringify(this.nhanviens[index]));
			this.showEdit=true;
		},
		postNhanVien(){
			this.nhanviens[this.index]=this.nhanvienedit;
			network.post('nhanvien', this.nhanvienedit)
			.then(message=>{
				console.log(message);
			});
			this.showEdit=false;
		}
	},
	mounted(){
		this.getNhanVien();
	}
}
</script>

<style scoped>
	#title{
		display: flex;
		justify-content: space-between;
	}
	.nhanvien{
		cursor: pointer;
		color: blue;
	}
	img{
		height: 200px;
		width: 200px;
	}
	p{
		font-weight: bold;
	}
</style>