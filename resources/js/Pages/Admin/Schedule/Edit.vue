<template>
    <Head>
        <title>{{ appName }} - Tambah Jadwal</title>
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
                            <li class="breadcrumb-item active" aria-current="page">Tambah Jadwal</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center">
                        <div class="ms-auto">
                            <Link href="/admin/schedules" class="btn btn-primary mt-2 mt-lg-0">Kembali</Link>
                        </div>
                    </div>
                    <form @submit.prevent="submit" class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Tanggal Ujian</label>
                            <input type="date" class="form-control" v-model="form.date" :class="{ 'is-invalid': errors.date }" placeholder="Tanggal Ujian">
                            <div v-if="errors.date" class="invalid-feedback">
                                {{ errors.date }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Jam Tes</label>
                            <input type="time" class="form-control" v-model="form.test_time" :class="{ 'is-invalid': errors.test_time }" placeholder="Jam Tes">
                            <div v-if="errors.test_time" class="invalid-feedback">
                                {{ errors.test_time }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Ruangan</label>
                            <select v-model="form.room_id" :class="{ 'is-invalid': errors.room_id }" class="form-select">
                                <option value="">[ Pilih Ruangan ]</option>
                                <option v-for="room in rooms" :key="room.id" :value="room.id">{{ room.name }}</option>
                            </select>
                            <div v-if="errors.room_id" class="invalid-feedback">
                                {{ errors.room_id }}
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Kuota Peserta</label>
                            <input type="number" class="form-control" v-model="form.quota" :class="{ 'is-invalid': errors.quota }" placeholder="Kuota peserta">
                            <div v-if="errors.quota" class="invalid-feedback">
                                {{ errors.quota }}
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
</template>

<script>
//import layout admin
import LayoutAdmin from '../../../Layouts/Layout.vue';

// import Link
import { Link } from '@inertiajs/inertia-vue3';

//import reactive
import { reactive } from 'vue';

// import Swal
import Swal from 'sweetalert2';

// import Head from Inertia
import {
    Head
} from '@inertiajs/inertia-vue3';

import { Inertia } from '@inertiajs/inertia';

//import tinyMCE
import Editor from '@tinymce/tinymce-vue';

//import axios
import axios from 'axios';

export default {
    // layout
    layout: LayoutAdmin,

    // register components
    components: {
        Link,
        Head,
        Editor
    },

    //props
    props: {
        errors: Object,
        rooms: Object,
        schedule: Object,
    },

    // initialization composition API
    setup(props) {
        const stringToTime = (string) => {
            const parts = string.split(':');
            const hours = String(parts[0]).padStart(2, '0');
            const minutes = String(parts[1]).padStart(2, '0');
            return `${hours}:${minutes}`;
        }

        const form = reactive({
            date: props.schedule.date,
            test_time: stringToTime(props.schedule.test_time),
            room_id: props.schedule.room_id,
            quota: props.schedule.quota,
        });

        // submit method
        const submit = () => {
            // send data to server
            Inertia.put(`/admin/schedules/${props.schedule.id}`, {
                // data
                date: form.date,
                test_time: form.test_time,
                room_id: form.room_id,
                quota: form.quota,
            }, {
                onSuccess: () => {
                    //show success alert
                    Swal.fire({
                        title: 'Success!',
                        text: 'Jadwal Berhasil Disimpan!.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    });
                },
            });
        }

        // return form state and submit method
        return {
            form,
            submit,
            stringToTime,
        }
    }
}
</script>
