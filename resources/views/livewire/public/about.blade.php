<section class="w-full">
    <x-app.header
        title="About me"
        subtitle="This is what I do"
    />

    <div class="mt-4 flex flex-col gap-6 lg:flex-row">
        <div class="min-h-150 w-full lg:w-2/3">
            <div class="flex flex-col gap-3">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur
                    voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam
                    ducimus consectetur?</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius praesentium recusandae illo eaque
                    architecto error, repellendus iusto reprehenderit, doloribus, minus sunt. Numquam at quae voluptatum
                    in officia voluptas voluptatibus, minus!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod
                    sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus,
                    corrupti enim modi! Et.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel molestiae in consequuntur dolores?
                    Fugit, eum porro? Necessitatibus quisquam unde libero maxime! Laboriosam, repudiandae possimus?
                    Tempore error illo incidunt magnam ducimus.</p>
                <p>Numquam esse laboriosam commodi eos eum exercitationem nisi harum doloremque mollitia eveniet
                    asperiores corrupti, quod quam error ducimus, voluptates odio, ut neque culpa provident? Minusg
                    ratione ullam ipsam harum magni.</p>
                <p>Pariatur iusto doloribus quia! Excepturi molestiae consequuntur at delectus voluptatem fugit quasi
                    quo, ullam omnis, ipsum aperiam tempore totam enim voluptates atque! Eaque temporibus laborum
                    ratione rem! Amet, error modi?</p>
                <p>Sunt saepe placeat dicta ipsam, assumenda consequatur in expedita voluptatem quisquam corporis
                    voluptas quaerat similique libero vel? Porro corrupti deserunt iste iusto quidem est unde, sunt
                    aperiam, possimus a itaque!</p>
                <p>Officiis quia atque amet necessitatibus cumque est quasi, perspiciatis vel sequi fugit, voluptatibus
                    deleniti sit, temporibus laborum accusantium iure ipsum distinctio maxime. Repellat ea ipsa atque
                    perferendis vel architecto ut.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/3">
            <x-tags
                :tags="$allTags"
                :tagId="$tagId"
            />
        </div>
    </div>
</section>
