<?php ($title = $product->name); ?>


<?php $__env->startSection('content'); ?>
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div>
        <img src="<?php echo e($product->image_url ?? 'https://via.placeholder.com/800x600?text=Produk'); ?>" alt="<?php echo e($product->name); ?>" class="w-full rounded-lg shadow">
    </div>
    <div>
        <h1 class="text-2xl font-semibold"><?php echo e($product->name); ?></h1>
        <div class="mt-2 flex items-center gap-3">
            <div>
                <?php for($i=1; $i<=5; $i++): ?>
                    <span class="star text-xl"><?php echo e($i <= floor($avg) ? '★' : '☆'); ?></span>
                <?php endfor; ?>
            </div>
            <div class="text-gray-600 text-sm"><?php echo e($avg); ?> dari 5 (<?php echo e($count); ?> ulasan)</div>
        </div>
        <div class="mt-3 text-3xl font-bold text-blue-700">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></div>
        <div class="mt-1 text-sm text-gray-600">Stok: <?php echo e($product->stock); ?></div>

        <div class="mt-4 space-y-2">
            <h2 class="font-semibold">Deskripsi</h2>
            <p class="text-gray-800"><?php echo nl2br(e($product->description)); ?></p>
        </div>

        <div class="mt-6">
            <a href="#review-form" class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700">Tulis Ulasan</a>
        </div>
    </div>
</div>

<div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="md:col-span-2">
        <h3 class="text-xl font-semibold mb-4">Ulasan Pembeli</h3>
        <?php $__empty_1 = true; $__currentLoopData = $product->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white p-4 rounded-lg shadow mb-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="font-medium"><?php echo e($r->user->name); ?></div>
                        <div class="text-sm text-gray-500"><?php echo e($r->created_at->diffForHumans()); ?></div>
                    </div>
                    <div>
                        <?php for($i=1; $i<=5; $i++): ?>
                            <span class="star"><?php echo e($i <= $r->rating ? '★' : '☆'); ?></span>
                        <?php endfor; ?>
                    </div>
                </div>
                <p class="mt-2"><?php echo nl2br(e($r->body)); ?></p>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-600">Belum ada ulasan untuk produk ini.</p>
        <?php endif; ?>
    </div>
    <div>
        <div id="review-form" class="bg-white p-4 rounded-lg shadow">
            <h4 class="font-semibold mb-3">Tulis Ulasan</h4>
            <?php if(auth()->guard()->check()): ?>
            <form method="POST" action="<?php echo e(route('reviews.store', $product)); ?>" class="space-y-3">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-sm font-medium">Rating</label>
                    <select name="rating" class="mt-1 border rounded px-3 py-2 w-full" required>
                        <?php for($i=5; $i>=1; $i--): ?>
                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?> - <?php echo e(str_repeat('★', $i)); ?></option>
                        <?php endfor; ?>
                    </select>
                    <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label class="block text-sm font-medium">Ulasan</label>
                    <textarea name="body" rows="4" class="mt-1 border rounded px-3 py-2 w-full" placeholder="Bagikan pengalaman Anda" required><?php echo e(old('body')); ?></textarea>
                    <?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <button class="bg-emerald-600 text-white w-full py-2 rounded hover:bg-emerald-700">Kirim Ulasan</button>
            </form>
            <?php else: ?>
                <p class="text-sm">Silakan <a href="<?php echo e(route('login')); ?>" class="text-blue-600 hover:underline">login</a> untuk menulis ulasan.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\laragon\www\KampuStore\KampuStore\resources\views/products/show.blade.php ENDPATH**/ ?>