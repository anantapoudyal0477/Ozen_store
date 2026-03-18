@extends('administrator.admin-layout-page')
@section('title', "Users Management")

@section('content')

<div id="users" class="relative py-20 px-4 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 overflow-hidden">

    <!-- Decorative Background Blobs -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute bottom-0 left-1/2 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>

    <div class="container mx-auto relative z-10">

        <!-- Section Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-2xl mb-6 transform hover:rotate-6 transition-transform duration-300">
                <i class="fas fa-users text-white text-2xl"></i>
            </div>
            <h2 class="text-5xl font-black mb-4 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent">
                Users Management
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Manage all registered users. Edit user details or remove users as necessary.
            </p>
        </div>

        <!-- Users Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

            @foreach($ListOfUsers as $user)
            <div class="group relative bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl overflow-hidden transform hover:-translate-y-3 hover:shadow-2xl transition-all duration-500">

                <div class="relative p-6 space-y-4">

                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300 line-clamp-2">
                        {{ $user->name }}
                    </h3>

                    <p class="text-gray-600 text-sm leading-relaxed line-clamp-2 min-h-[2.5rem]">
                        {{ $user->email }}
                    </p>

                    <div class="flex items-center justify-end pt-4 border-t border-gray-100 space-x-3">

                        <!-- Edit Button -->
                        <button class="editBtn group/btn relative w-11 h-11 bg-gradient-to-br from-amber-400 to-orange-500 hover:from-amber-500 hover:to-orange-600 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-110 flex items-center justify-center"
                                data-id="{{ $user->id }}">
                            <i class="fas fa-edit text-white text-lg"></i>
                            <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs px-3 py-1 rounded-lg opacity-0 group-hover/btn:opacity-100 transition-opacity pointer-events-none">
                                Edit User
                            </div>
                        </button>

                        <!-- Delete Button -->
                        <button class="deleteBtn group/btn relative w-11 h-11 bg-gradient-to-br from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-110 flex items-center justify-center"
                                data-id="{{ $user->id }}">
                            <i class="fas fa-trash text-white text-lg"></i>
                            <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-xs px-3 py-1 rounded-lg opacity-0 group-hover/btn:opacity-100 transition-opacity pointer-events-none">
                                Delete User
                            </div>
                        </button>

                    </div>
                </div>
            </div>

            <!-- Edit User Modal -->
            <div id="edit-modal-{{ $user->id }}" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 hidden p-4 overflow-y-auto">
                <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 my-8 relative transform scale-95 opacity-0 transition-all duration-300"
                     style="animation: modalFadeIn 0.3s ease-out forwards;">

                    <!-- Close Button -->
                    <button class="closeBtn absolute top-6 right-6 w-10 h-10 bg-gray-100 hover:bg-red-100 rounded-full flex items-center justify-center text-gray-600 hover:text-red-600 transition-all duration-300 group">
                        <span class="text-2xl group-hover:rotate-90 transition-transform duration-300">&times;</span>
                    </button>

                    <h1 class="text-3xl font-black text-gray-900 mb-6 text-center">Edit User</h1>

                    <form id="EditUserForm-{{ $user->id }}" action="{{ route('Administrator.UsersManagement.update', $user->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">

                        <div>
                            <label class="block text-gray-700 font-bold mb-1">Name</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="w-full border rounded-xl p-3" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-1">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="w-full border rounded-xl p-3" required>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" class="cancelBtn px-4 py-2 bg-gray-200 rounded-lg">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete User Modal -->
            <div id="delete-modal-{{ $user->id }}" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 hidden p-4 overflow-y-auto">
                <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 my-8 relative">

                    <h1 class="text-3xl font-black text-gray-900 mb-6 text-center">Delete User</h1>

                    <p class="text-gray-700 mb-6 text-center">Are you sure you want to delete <strong>{{ $user->name }}</strong>?</p>

                    <form id="DeleteUserForm-{{ $user->id }}" action="{{ route('Administrator.UsersManagement.delete', $user->id) }}" method="POST" class="flex justify-end space-x-3">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="cancelBtn px-4 py-2 bg-gray-200 rounded-lg">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">Delete</button>
                    </form>
                </div>
            </div>

            @endforeach

        </div>
    </div>
</div>

<style>
@keyframes blob {0%,100%{transform:translate(0,0) scale(1);}33%{transform:translate(30px,-50px) scale(1.1);}66%{transform:translate(-20px,20px) scale(0.9);}}
@keyframes modalFadeIn{to{transform:scale(1);opacity:1;}}
.animate-blob{animation:blob 7s infinite;}
.animation-delay-2000{animation-delay:2s;}
.animation-delay-4000{animation-delay:4s;}
.line-clamp-2{-webkit-box-orient:vertical;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;}
</style>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function(){

    // Open edit modal
    $(".editBtn").click(function(){
        let id = $(this).data("id");
        $("#edit-modal-" + id).removeClass("hidden");
    });

    // Open delete modal
    $(".deleteBtn").click(function(){
        let id = $(this).data("id");
        $("#delete-modal-" + id).removeClass("hidden");
    });

    // Close modals
    $(".closeBtn, .cancelBtn").click(function(){
        $(this).closest('div[id^="edit-modal-"], div[id^="delete-modal-"]').addClass("hidden");
    });

    // Submit edit form via AJAX
    $('[id^="EditUserForm-"]').submit(function(e){
        e.preventDefault();
        let form = $(this);
        let url = form.attr('action');
        $.post(url, form.serialize())
            .done(function(res){
                alert('User updated successfully!');
                location.reload();
            })
            .fail(function(xhr){
                alert('Update failed: ' + xhr.responseText);
            });
        form.closest('div[id^="edit-modal-"]').addClass("hidden");
    });

    // Submit delete form via AJAX
    $('[id^="DeleteUserForm-"]').submit(function(e){
        e.preventDefault();
        let form = $(this);
        let url = form.attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
            success: function(res){
                alert('User deleted successfully!');
                location.reload();
            },
            error: function(xhr){
                alert('Delete failed: ' + xhr.responseText);
            }
        });
        form.closest('div[id^="delete-modal-"]').addClass("hidden");
    });

});
</script>

@endsection
