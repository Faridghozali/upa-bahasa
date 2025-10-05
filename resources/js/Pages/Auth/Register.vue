<template>
    <Head>
        <title>e-TOEFL - Register</title>
    </Head>

    <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                <div class="col mx-auto">
                    <div class="my-4 text-center">
                        <img src="/assets/images/logo-img.png" width="180" alt="" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center">
                                    <h3 class="">Registrasi</h3>
                                    <p>Sudah memiliki akun ? <Link href="/login">Login disini</Link></p>
                                </div>
                                <div class="form-body">
                                    <form @submit.prevent="submit" class="row g-3">

                                        <!-- FOTO -->
                                        <div class="col-12">
                                            <label class="form-label">Foto</label>
                                            <input
                                                type="file"
                                                accept="image/*"
                                                @change="handleFileChange"
                                                :class="{ 'is-invalid': errors.photo }"
                                                class="form-control"
                                            >
                                            <div v-if="errors.photo" class="invalid-feedback">
                                                {{ errors.photo }}
                                            </div>
                                            <!-- Preview -->
                                            <div v-if="preview" class="mt-3 text-center">
                                                <img :src="preview" alt="Preview Foto" class="img-thumbnail" style="max-height: 200px;">
                                            </div>
                                        </div>

                                        <!-- NAMA -->
                                        <div class="col-12">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" v-model="form.name" :class="{ 'is-invalid': errors.name }" class="form-control" placeholder="Nama Lengkap">
                                            <div v-if="errors.name" class="invalid-feedback">
                                                {{ errors.name }}
                                            </div>
                                        </div>

                                        <!-- GENDER -->
                                        <div class="col-12">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <select v-model="form.gender" :class="{ 'is-invalid': errors.gender }" class="form-select">
                                                <option value="">[ Pilih ]</option>
                                                <option value="M">Laki-laki</option>
                                                <option value="F">Perempuan</option>
                                            </select>
                                            <div v-if="errors.gender" class="invalid-feedback">
                                                {{ errors.gender }}
                                            </div>
                                        </div>

                                        <!-- Nomor HP -->
                                        <div class="col-12">
                                            <label class="form-label">Nomor Hp (WA Aktif Untuk Aktivasi Akun)</label>
                                            <input type="text" v-model="form.phone_number" :class="{ 'is-invalid': errors.phone_number }" class="form-control" placeholder="Nomor Hp (WA Aktif)">
                                            <div v-if="errors.phone_number" class="invalid-feedback">
                                                {{ errors.phone_number }}
                                            </div>
                                        </div>

                                        <!-- PROVINSI -->
                                        <div class="col-12">
                                            <label class="form-label">Provinsi</label>
                                            <select  @change="cityData" v-model="form.province_id" :class="{ 'is-invalid': errors.province_id }" class="form-select">
                                                <option value="">[ Pilih ]</option>
                                                <option v-for="province in provinces" :value="province.id">
                                                    {{ province.name }}
                                                </option>
                                            </select>
                                            <div v-if="errors.province_id" class="invalid-feedback">
                                                {{ errors.province_id }}
                                            </div>
                                        </div>

                                        <!-- KOTA -->
                                        <div class="col-12">
                                            <label class="form-label">Kota / Kab</label>
                                            <select @change="districtData" v-model="form.city_id" :class="{ 'is-invalid': errors.city_id }" class="form-select">
                                                <option value="">[ Pilih ]</option>
                                                <option v-for="city in form.cities" :value="city.id">
                                                    {{ city.name }}
                                                </option>
                                            </select>
                                            <div v-if="errors.city_id" class="invalid-feedback">
                                                {{ errors.city_id }}
                                            </div>
                                        </div>

                                        <!-- KECAMATAN -->
                                        <div class="col-12">
                                            <label class="form-label">Kecamatan</label>
                                            <select @change="villageData" v-model="form.district_id" :class="{ 'is-invalid': errors.district_id }" class="form-select">
                                                <option value="">[ Pilih ]</option>
                                                <option v-for="district in form.districts" :value="district.id">
                                                    {{ district.name }}
                                                </option>
                                            </select>
                                            <div v-if="errors.district_id" class="invalid-feedback">
                                                {{ errors.district_id }}
                                            </div>
                                        </div>

                                        <!-- DESA -->
                                        <div class="col-12">
                                            <label class="form-label">Desa / Kelurahan</label>
                                            <select v-model="form.village_id" :class="{ 'is-invalid': errors.village_id }" class="form-select">
                                                <option value="">[ Pilih ]</option>
                                                <option v-for="village in form.villages" :value="village.id">
                                                    {{ village.name }}
                                                </option>
                                            </select>
                                            <div v-if="errors.village_id" class="invalid-feedback">
                                                {{ errors.village_id }}
                                            </div>
                                        </div>

                                        <!-- ALAMAT -->
                                        <div class="col-12">
                                            <label class="form-label">Alamat</label>
                                            <textarea cols="30" rows="10" v-model="form.address" :class="{ 'is-invalid': errors.address }" class="form-control" placeholder="Alamat RT/RW/No Rumah"></textarea>
                                            <div v-if="errors.address" class="invalid-feedback">
                                                {{ errors.address }}
                                            </div>
                                        </div>

                                        <!-- EMAIL -->
                                        <div class="col-12">
                                            <label class="form-label">Email</label>
                                            <input type="email" v-model="form.email" :class="{ 'is-invalid': errors.email }" class="form-control" placeholder="Email">
                                            <div v-if="errors.email" class="invalid-feedback">
                                                {{ errors.email }}
                                            </div>
                                        </div>

                                        <!-- PASSWORD -->
                                        <div class="col-12">
                                            <label class="form-label">Password</label>
                                            <input type="password" v-model="form.password" :class="{ 'is-invalid': errors.password }" class="form-control" placeholder="Password">
                                            <div v-if="errors.password" class="invalid-feedback">
                                                {{ errors.password }}
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Konfirmasi Password</label>
                                            <input type="password" v-model="form.password_confirmation" :class="{ 'is-invalid': errors.password_confirmation }" class="form-control" placeholder="Konfirmasi Password">
                                            <div v-if="errors.password_confirmation" class="invalid-feedback">
                                                {{ errors.password_confirmation }}
                                            </div>
                                        </div>

                                        <!-- SUBMIT -->
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class='bx bx-user'></i> Registrasi
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</template>

<script>
import LayoutAuth from '../../Layouts/Auth.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { reactive, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';

export default {
    layout: LayoutAuth,
    components: { Head, Link },

    props: {
        errors: Object,
        session: Object,
        cities: Object,
    },

    data() {
        return {
            provinces: [],
            preview: null,
        }
    },

    mounted() {
        axios.get('region/province').then(response => {
            this.provinces = response.data;
        }).catch(error => console.error(error));
    },

    setup(props) {
        const form = reactive({
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            province_id: '',
            city_id: '',
            district_id: '',
            village_id: '',
            address: '',
            phone_number: '',
            gender: '',
            photo: null,
            // get from api
            cities: [],
            districts: [],
            villages: [],
        });

        const preview = ref(null);

        const handleFileChange = (e) => {
            const file = e.target.files[0];
            if (file) {
                form.photo = file;
                preview.value = URL.createObjectURL(file);
            }
        };

        const cityData = () => {
            form.city_id = '';
            form.district_id = '';
            form.village_id = '';
            axios.get(`/region/city/${form.province_id}`).then(response => {
                form.cities = response.data;
            }).catch(error => console.error(error));
        }

        const districtData = () => {
            form.district_id = '';
            form.village_id = '';
            axios.get(`/region/district/${form.city_id}`).then(response => {
                form.districts = response.data;
            }).catch(error => console.error(error));
        }

        const villageData = () => {
            form.village_id = '';
            axios.get(`/region/village/${form.district_id}`).then(response => {
                form.villages = response.data;
            }).catch(error => console.error(error));
        }

        const submit = () => {
            const data = new FormData();
            data.append('name', form.name);
            data.append('email', form.email);
            data.append('password', form.password);
            data.append('password_confirmation', form.password_confirmation);
            data.append('province_id', form.province_id);
            data.append('city_id', form.city_id);
            data.append('district_id', form.district_id);
            data.append('village_id', form.village_id);
            data.append('address', form.address);
            data.append('phone_number', form.phone_number);
            data.append('gender', form.gender);
            if (form.photo) {
                data.append('photo', form.photo);
            }

            Inertia.post('/register', data, {
                forceFormData: true,
            });
        }

        return {
            form,
            preview,
            submit,
            handleFileChange,
            cityData,
            districtData,
            villageData
        }
    }
}
</script>
