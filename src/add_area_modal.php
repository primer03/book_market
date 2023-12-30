<dialog id="my_modal_1" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">เพิ่มพื้นที่ขาย</h3>
        <div class=" mt-1 modal-action justify-center flex-col gap-3">
            <form action="">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text">เลือกตำแหน่งคอลัม</span>
                    </div>
                    <select id="selectcol" class="select select-bordered w-full">

                    </select>
                </label>
                <div class="flex gap-3">
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">กว้าง</span>
                        </div>
                        <input type="number" placeholder="Type here" class="input input-bordered w-full max-w-xs " />
                    </label>
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">ยาว</span>
                        </div>
                        <input type="number" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                    </label>
                </div>
                <p class="my-3">เลือกสีพื้นหลัง <span class="text-xs text-red-700">* ถ้าไม่เลือกพื้นหลังจะเป็นสีขาว</span></p>
                <div class=" grid grid-cols-8 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-3">
                    <div id="pickbg" class="w-7 h-7 bg-slate-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-gray-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-zinc-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-neutral-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-stone-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-red-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-orange-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-amber-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-yellow-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-lime-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-green-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-emerald-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-teal-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-cyan-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-sky-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-blue-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-indigo-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-violet-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-purple-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-fuchsia-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-pink-500"></div>
                    <div id="pickbg" class="w-7 h-7 bg-rose-500"></div>
                </div>
                <p class="my-3">เลือกสีพื้นหลัง<span class="text-xs text-red-700">* ถ้าไม่เลือกขอบจะเป็นสีดำ</span></p>
                <div class=" grid grid-cols-8 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-3">
                    <div id="pickborder" class="w-7 h-7 border-2 border-slate-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-gray-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-zinc-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-neutral-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-stone-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-red-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-orange-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-amber-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-yellow-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-lime-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-green-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-emerald-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-teal-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-cyan-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-sky-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-blue-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-indigo-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-violet-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-purple-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-fuchsia-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-pink-700"></div>
                    <div id="pickborder" class="w-7 h-7 border-2 border-red-700"></div>
                </div>
                <p class="my-3">เลือกสีตัวอักษร <span class="text-xs text-red-700">* ถ้าไม่เลือกตัวอะกษรจะเป็นสีดำ</span></p>
                <div class=" grid grid-cols-8 md:grid-cols-12 lg:grid-cols-12 xl:grid-cols-12 gap-3">
                    <div id="picktext" class="w-7 h-7 bg-slate-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-gray-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-zinc-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-neutral-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-stone-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-red-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-orange-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-amber-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-yellow-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-lime-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-green-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-emerald-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-teal-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-cyan-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-sky-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-blue-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-indigo-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-violet-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-purple-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-fuchsia-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-pink-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-rose-900"></div>
                    <div id="picktext" class="w-7 h-7 bg-white border-2 border-slate-800"></div>
                </div>
            </form>
        </div>
        <div class=" flex justify-end mt-3 gap-3">
            <button id="save-area" class="btn  btn-success">เพิ่ม</button>
            <button id="close-modal" class="btn">Close</button>
        </div>
    </div>
</dialog>