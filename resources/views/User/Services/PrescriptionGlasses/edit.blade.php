
<form action="{{ route('User.services.PrescriptionGlasses.edit') }}">
<div class="grid grid-cols-2 gap-4 border rounded-lg p-4">
    <!-- Left Eye -->
    <div class="pr-2 border-r border-gray-300">
        <h3 class="font-semibold mb-2">Left Eye</h3>
        <div class="mb-2">
            <label class="block text-sm">SPH</label>
            <input type="text" name="left_sphere" id="left_sphere"
                class="w-full border rounded p-2">
        </div>
        <div class="mb-2">
            <label class="block text-sm">CYL</label>
            <input type="text" name="left_cylinder" id="left_cylinder"
                class="w-full border rounded p-2">
        </div>
        <div class="mb-2">
            <label class="block text-sm">AXIS</label>
            <input type="text" name="left_axis" id="left_axis"
                class="w-full border rounded p-2">
        </div>
    </div>

    <!-- Right Eye -->
    <div class="pl-2">
        <h3 class="font-semibold mb-2">Right Eye</h3>
        <div class="mb-2">
            <label class="block text-sm">SPH</label>
            <input type="text" name="right_sphere" id="right_sphere"
                class="w-full border rounded p-2">
        </div>
        <div class="mb-2">
            <label class="block text-sm">CYL</label>
            <input type="text" name="right_cylinder" id="right_cylinder"
                class="w-full border rounded p-2">
        </div>
        <div class="mb-2">
            <label class="block text-sm">AXIS</label>
            <input type="text" name="right_axis" id="right_axis"
                class="w-full border rounded p-2">
        </div>
    </div>
</div>

<!-- PD input below -->
<div class="mt-4">
    <label class="block text-sm">PD</label>
    <input type="text" name="pd" id="pd" class="w-full border rounded p-2">
</div>
</form>
