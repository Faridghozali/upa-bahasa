<template>
    <Head>
        <title>{{ appName }} - Kategori</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Ujian</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Jadwal</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <h4 class="mb-0 text-uppercase text-center">Pilih Jadwal Ujianmu.....</h4>
            <hr/>
            <div class="row">
                <div class="col-lg-12 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mt-4">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
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
                            <tr v-if="availableSchedules.length === 0">
                                <td colspan="8" class="text-center">Belum ada jadwal tersedia.</td>
                            </tr>
                            <tr v-for="(schedule, index) in availableSchedules" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ schedule.day }}</td>
                                <td>{{ formatDate(schedule.date) }}</td>
                                <td>{{ schedule.test_time }}</td>
                                <td>{{ schedule.room.name }}</td>
                                <td>{{ schedule.quota }}</td>
                                <td>{{ schedule.participants }}</td>
                                <td>
                                    <Link :href="`/user/schedules/${schedule.id}/categories`" class="btn btn-outline-primary">
                                        Pilih
                                    </Link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
</template>

<script>
//import layout admin
import LayoutUser from '../../../../Layouts/Layout.vue';

// import Link & Head dari inertia
import { Link, Head } from '@inertiajs/inertia-vue3';

export default {
    // layout
    layout: LayoutUser,

    // register components
    components: {
        Link,
        Head,
    },

    // props
    props: {
        schedules: {
            type: Array,
            required: true
        }
    },

    computed: {
        availableSchedules() {
            // hanya tampilkan jadwal yg belum penuh
            return this.schedules.filter(s => s.participants < s.quota);
        }
    },

    methods: {
        formatDate(date) {
            // contoh sederhana, bisa pakai Intl.DateTimeFormat juga
            return new Date(date).toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            });
        }
    }
}
</script>
