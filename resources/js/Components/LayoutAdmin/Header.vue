<template>
    <!--start header -->
    <header>
        <div class="topbar d-flex align-items-center">
            <nav class="navbar navbar-expand">
                <!-- Mobile Menu -->
                <div class="mobile-toggle-menu d-flex align-items-center">
                    <i class="bx bx-menu"></i>
                    <span class="ms-2" style="font-size:14pt;">Menu</span>
                </div>

                <div class="top-menu ms-auto"></div>

                <!-- User Dropdown -->
                <div class="user-box dropdown">
                    <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret"
                       href="#" role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">

                        <!-- ✅ Conditional fallback: foto user atau default -->
                        <img
                            :src="user?.student?.photo_path
                                ? '/storage/' + user.student.photo_path
                                : '/assets/images/user_icon.png'"
                            class="user-img"
                            alt="user avatar"
                        >

                        <div class="user-info ps-3">
                            <p class="user-name mb-0">{{ user?.name }}</p>
                            <p class="designation mb-0">{{ user?.email }}</p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <Link class="dropdown-item" href="/admin/dashboard">
                                <i class="bx bx-home-circle"></i>
                                <span>Dashboard</span>
                            </Link>
                        </li>
                        <li><div class="dropdown-divider mb-0"></div></li>
                        <li>
                            <Link class="dropdown-item" href="/logout" method="POST" as="button">
                                <i class="bx bx-log-out-circle"></i>
                                <span>Logout</span>
                            </Link>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
</template>

<script>
import { Link, usePage } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'

export default {
    name: "Header",
    components: { Link },
    setup() {
        const page = usePage()
        const user = computed(() => page.props.value.auth.user)

        return {
            user
        }
    },
    mounted() {
        console.log(this.user)
    }
}
</script>

<style scoped>
.user-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}
</style>
