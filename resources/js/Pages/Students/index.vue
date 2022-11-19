<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head,Link } from '@inertiajs/inertia-vue3';

const props  = defineProps({
    students:Array
});
function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        Inertia.delete(route("student.destroy", id));
    }
}
</script>

<template>
    <Head title="Students" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Student Index
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <Link href="/student/create" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-6 text-white rounded">Create</Link>
            </div>
               <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Id
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider" >
                            Name
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider" >
                            Age
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"  >
                            Image
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"  >
                            Status
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100" ></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="student in students" :key="student.id">
                        
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{student.id}}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{student.name}}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{student.age}}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex">
                            <div class="flex-shrink-0 w-10 h-10">
                                <img
                                class="w-full h-full rounded-full"
                                :src="student.image"
                                alt=""
                                />
                            </div>
                            
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{student.status}}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right" >
                            <Link :href="`/student/${student.id}/edit`" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                edit
                            </Link>
                            <!-- method="delete" as="button":href="`/student/${student.id}`"  -->
                            <Link   @click="destroy(student.id)" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Delete
                            </Link>
                        </td>
                        </tr>
           
                    </tbody>
                    </table>
                </div>
                <div v-if="$page.props.flash.message" class="toast-container position-fixed bottom-0 end-0 p-3">
                    {{ $page.props.flash.message }}
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
