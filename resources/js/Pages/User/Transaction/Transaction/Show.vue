<template>
    <Head>
        <title>{{ appName }} - Detail Transaksi</title>
    </Head>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div
                class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"
            >
                <div class="breadcrumb-title pe-3">Transaksi</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:;"
                                    ><i class="bx bx-home-alt"></i
                                ></a>
                            </li>
                            <li
                                class="breadcrumb-item active"
                                aria-current="page"
                            >
                                Detail Transaksi
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="card">
                <div class="card-body">
                    <div id="invoice">
                        <div class="invoice overflow-auto">
                            <div style="min-width: 600px">
                                <header>
                                    <div class="row">
                                        <div class="col">
                                            <span
                                                class="badge bg-warning"
                                                v-if="
                                                    transaction.transaction_status ==
                                                    'pending'
                                                "
                                            >
                                                <h6
                                                    style="
                                                        color: #000;
                                                        height: 10px;
                                                    "
                                                >
                                                    Menunggu Pembayaran
                                                </h6>
                                            </span>

                                            <span
                                                class="badge bg-success"
                                                v-if="
                                                    transaction.transaction_status ==
                                                    'paid'
                                                "
                                            >
                                                <h6
                                                    style="
                                                        color: #fff;
                                                        height: 10px;
                                                    "
                                                >
                                                    Sudah Dibayar, Menunggu
                                                    Verifikasi Admin
                                                </h6>
                                            </span>

                                            <span
                                                class="badge bg-danger"
                                                v-if="
                                                    transaction.transaction_status ==
                                                    'failed'
                                                "
                                            >
                                                <h6
                                                    style="
                                                        color: #fff;
                                                        height: 10px;
                                                    "
                                                >
                                                    Transaksi Gagal
                                                </h6>
                                            </span>

                                            <span
                                                class="badge bg-primary"
                                                v-if="
                                                    transaction.transaction_status ==
                                                    'done'
                                                "
                                            >
                                                <h6
                                                    style="
                                                        color: #fff;
                                                        height: 10px;
                                                    "
                                                >
                                                    Transaksi Selesai
                                                </h6>
                                            </span>
                                        </div>
                                        <div class="col company-details">
                                            <h2 class="name">
                                                <a
                                                    target="_blank"
                                                    href="javascript:;"
                                                >
                                                    {{ appName }}
                                                </a>
                                            </h2>
                                            <div>{{ alamat }}</div>
                                            <div>{{ wa }}</div>
                                            <div>{{ email }}</div>
                                        </div>
                                    </div>
                                </header>
                                <main>
                                    <div class="row contacts">
                                        <div class="col invoice-to">
                                            <div class="text-gray-light">
                                                Faktur Untuk:
                                            </div>
                                            <h2 class="to">
                                                {{ transaction.user.name }}
                                            </h2>
                                            <div class="address">
                                                {{
                                                    transaction.user.student
                                                        .address
                                                }}, Desa/Kel.
                                                {{
                                                    transaction.user.student
                                                        .village.name
                                                }}, Kec.
                                                {{
                                                    transaction.user.student
                                                        .district.name
                                                }}, Kota/Kab.
                                                {{
                                                    transaction.user.student
                                                        .city.name
                                                }}, Provinsi
                                                {{
                                                    transaction.user.student
                                                        .province.name
                                                }}
                                                <br />
                                                {{
                                                    transaction.user.student
                                                        .phone_number
                                                }}
                                            </div>
                                            <div class="email">
                                                {{ transaction.user.email }}
                                            </div>
                                        </div>
                                        <div class="col invoice-details">
                                            <h1 class="invoice-id">
                                                {{ transaction.code }}
                                            </h1>
                                            <div class="date">
                                                Tanggal Faktur :
                                                {{ transaction.created_at }}
                                            </div>
                                            <div class="date">
                                                Batas Waktu Pembayaran:
                                                {{
                                                    transaction.maximum_payment_time
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-left">
                                                    Deskripsi
                                                </th>
                                                <th class="text-right">
                                                    Harga
                                                </th>
                                                <th class="text-right">
                                                    Diskon
                                                </th>
                                                <th class="text-right">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="no">01</td>
                                                <td class="text-left">
                                                    Pembelian
                                                    {{ transaction.exam.title }}
                                                </td>
                                                <td class="unit">
                                                    {{
                                                        formatPrice(
                                                            transaction.total_purchases
                                                        )
                                                    }}
                                                </td>
                                                <td class="qty">
                                                    {{ formatPrice(0) }}
                                                </td>
                                                <td class="total">
                                                    {{
                                                        formatPrice(
                                                            transaction.total_purchases
                                                        )
                                                    }}
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2">Sub Total</td>
                                                <td>
                                                    {{
                                                        formatPrice(
                                                            transaction.total_purchases
                                                        )
                                                    }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2">Pajak 0%</td>
                                                <td>Rp. 0.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2">
                                                    TOTAL PEMBAYARAN
                                                </td>
                                                <td>
                                                    {{
                                                        formatPrice(
                                                            transaction.total_purchases
                                                        )
                                                    }}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div
                                        v-if="
                                            transaction.transaction_status ==
                                            'pending'
                                        "
                                    >
                                        <div class="thanks">Terimakasih</div>
                                        <br />
                                        <h4 class="text-center">
                                            Silakan lakukan pembayaran
                                        </h4>
                                        <br />
                                        <div class="text-center">
                                            <button
                                                v-on:click="payment"
                                                href="#"
                                                class="btn btn-outline-primary"
                                            >
                                                Bayar sekarang
                                            </button>
                                        </div>
                                        <br />
                                        <div class="notices">
                                            <div>Perhatian!</div>
                                            <div class="notice">
                                                Batas waktu pembayaran akan
                                                Habis pada 2 hari (2 x 24 jam)
                                                dari waktu transaksi, maka
                                                lakukan pembayaran & konfirmasi
                                                sebelum
                                                <span class="badge bg-danger"
                                                    >{{
                                                        transaction.maximum_payment_time
                                                    }} </span
                                                ><br /><br />
                                                Setelah melakukan pembayaran,
                                                silakan lakukan konfirmasi
                                                melalui Whatsapp di
                                                <b>{{ wa }}</b> dengan
                                                menyertakan nomor faktur serta
                                                bukti transfer pembayaran.
                                                terimakasih
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        v-if="
                                            transaction.transaction_status ==
                                            'done'
                                        "
                                    >
                                        <div class="text-center">
                                            <h3 class="fw-bold text-success">
                                                🎉 Pembayaran Berhasil!
                                            </h3>
                                            <p class="text-muted">
                                                Terima kasih, pembayaran Anda
                                                telah kami terima.
                                            </p>
                                        </div>

                                        <div class="text-center mt-4">
                                            <a
                                                target="_blank"
                                                :href="`/user/transactions/${transaction.id}/print-exam-card`"
                                                class="btn btn-outline-primary px-4"
                                            >
                                                <i
                                                    class="bi bi-file-earmark-text me-2"
                                                ></i>
                                                Cetak kartu peserta
                                            </a>
                                        </div>
                                    </div>

                                    <h5></h5>
                                </main>
                                <footer>
                                    Faktur dibuat di komputer dan berlaku tanpa
                                    tanda tangan dan stempel.
                                </footer>
                            </div>
                            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
</template>

<script>
import axios from "axios";

import Swal from "sweetalert2";

import { Inertia } from "@inertiajs/inertia";

//import layout admin
import LayoutUser from "../../../../Layouts/Layout.vue";

// import Link
import { Link } from "@inertiajs/inertia-vue3";

// import Head from Inertia
import { Head } from "@inertiajs/inertia-vue3";

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
        transaction: Object,
        banks: Object,
    },

    methods: {
        formatPrice(value) {
            let val = (value / 1).toFixed().replace(".", ",");
            return "Rp." + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },

        payment() {
            let transactionId = this.transaction.id;

            axios
                .post(`/api/transactions/${transactionId}/callback`, {
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                })
                .then((response) => {
                    let snapToken = response.data.data.snap_token;

                    window.snap.pay(snapToken, {
                        onSuccess: (result) => {
                            axios
                                .put(
                                    `/api/transactions/${transactionId}/payment-success`,
                                    {
                                        headers: {
                                            "Content-Type": "application/json",
                                            Accept: "application/json",
                                        },
                                        data: {
                                            snap_token: snapToken,
                                        },
                                    }
                                )
                                .then((res) => {
                                    Swal.fire({
                                        title: "Success!",
                                        text: "Pembayaran berhasil",
                                        icon: "success",
                                    });

                                    Inertia.reload({ only: ["transaction"] });
                                })
                                .catch((err) => {
                                    console.error(
                                        "Failed update payment:",
                                        err.response ?? err
                                    );
                                });
                        },
                        onPending: (result) => {
                            alert("Menunggu pembayaran!");
                            console.log(result);
                        },
                        onError: (result) => {
                            alert("Pembayaran gagal!");
                            console.log(result);
                        },
                        onClose: () => {
                            alert(
                                "Kamu menutup popup tanpa menyelesaikan pembayaran"
                            );
                        },
                    });
                })
                .catch((error) => {
                    console.error("Callback error:", error.response ?? error);
                });
        },
    },
};
</script>
