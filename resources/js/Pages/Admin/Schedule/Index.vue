<template>
    <Head>
        <title>{{ appName}} - Data Jadwal</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Jadwal</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Jadwal</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                        <form @submit.prevent="handleSearch">
                            <div class="position-relative">
                                <input type="text" v-model="search" class="form-control ps-5 radius-20" placeholder="Cari Berdasarkan Judul...."> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                            </div>
                        </form>
                        <div class="ms-auto">
                            <Link href="/admin/schedules/create" class="btn btn-primary mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> Tambah Jadwal</Link>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Tanggal</th>
                                <th>Jam Tes</th>
                                <th>Ruang</th>
                                <th>Kuota</th>
                                <th>Peserta</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td align="center" colspan="8" v-if="!schedules.data.length">Data Jadwal kosong</td>
                            </tr>
                            <tr v-for="(schedule, index) in schedules.data" :key="index">
                                <td>{{ index + 1 + (schedules.current_page - 1) * schedules.per_page }}</td>
                                <td>{{ schedule.day }}</td>
                                <td>{{ schedule.date}}</td>
                                <td>{{ schedule.test_time }}</td>
                                <td>{{ schedule.room.name }}</td>
                                <td>{{ schedule.quota }}</td>
                                <td>{{ schedule.participants}}</td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <Link :href="`/admin/schedules/${schedule.id}/edit`" class="ms-1"><i class='bx bxs-edit'></i></Link>
                                        <a href="#" @click.prevent="destroy(schedule.id)" class="ms-1"><i class="bx bxs-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>

                        </table>
                    </div>

                    <Pagination :links="schedules.links" align="end" />
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
</template>

<script>
//import layout admin
import LayoutAdmin from '../../../Layouts/Layout.vue';

//import component pagination
import Pagination from '../../../Components/Pagination.vue';

// import Link
import { Link } from '@inertiajs/inertia-vue3';

//import sweet alert2
import Swal from 'sweetalert2';

//import ref from vue
import {
    ref
} from 'vue';

// import Head from Inertia
import {
    Head
} from '@inertiajs/inertia-vue3';

import { Inertia } from '@inertiajs/inertia';

export default {
    // layout
    layout: LayoutAdmin,

    // register components
    components: {
        Link,
        Head,
        Pagination
    },

    // props
    props: {
        schedules: Object
    },

    // initialization composition API
    setup() {

        // define state search
        const search = ref('' || (new URL(document.location)).searchParams.get('search'));

        // define method search
        const handleSearch = () => {
            Inertia.get('/admin/schedules', {
                //send params "search" with value from state "search"
                search: search.value,
            })
        }

        const destroy = (id) => {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            })
                .then((result) => {
                    if (result.isConfirmed) {

                        Inertia.delete(`/admin/schedules/${id}`);

                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Jadwal Berhasil Dihapus!.',
                            icon: 'success',
                            timer: 1000,
                            showConfirmButton: false,
                        });
                    }
                })
        }

        return {
            search,
            handleSearch,
            destroy
        }
    },

    mounted() {
        console.log('schedules', this.schedules);
    }
}
</script>
