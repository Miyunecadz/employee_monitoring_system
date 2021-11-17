<template>
    <Head title="List of Users" />

    <BreezeAuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                    <div class="grid gap-2 md:flex">
                        <div class="md:mr-auto">
                            <form @submit.prevent="submit">
                                <div class="grid grid-rows-2 gap-2 md:flex">
                                    <Input id="keyword" type="text" class="mt-1 block sm:w-full md:w-10/12" v-model="form.keyword" autofocus autocomplete="username" placeholder="Keyword..." />
                                    <Button class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Filter
                                    </Button>
                                </div>
                            </form>
                        </div>

                        <Link class="bg-blue-700 hover:bg-blue-500 text-white font-bold py-3 text-sm px-3 rounded" >
                            New User
                        </Link>
                    </div>


                    <hr class="md:hidden my-2" />

                    <div class="flex flex-col mt-4">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Username
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="user in users.data" :key="user.id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ user.name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ user.username }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ user.email }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ user.role }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        </div>
                    </div>

                        <pagination :links="users.links"  class="pt-3"/>

                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Pagination from '@/Components/Pagination.vue'
import { Head } from '@inertiajs/inertia-vue3';
import Input from '@/Components/Input.vue'
import Button from '@/Components/Button.vue'
import Link from '@/Components/Link.vue'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Pagination,
        Input,
        Button,
        Link
    },
    props: {
        users: Object,

    },
    data(){
        return{
            form: this.$inertia.form({
                keyword: ''
            })
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('users.filter'))
        }
    }
}
</script>
