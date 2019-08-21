<?= selfRender('Dashboard', 'partials/top-navigation.php') ?>

<div class="container-fluid">
    <div class="row">

        <?= selfRender('Dashboard', 'partials/left-menu.php') ?>

        <main role="main" class="col-md-12 ml-sm-auto col-lg-12 dashboard-container">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <? if (isset($object)): ?>
                    <h2>Update Sitemap</h2>
                <? else: ?>
                    <h2>Add new Sitemap</h2>
                <? endif; ?>
            </div>

            <form data_id="<? if (isset($object)): ?>_SITEMAP_UPDATE<? else: ?>_SITEMAP_CREATE<? endif ?>"
                  action="<?= (isset($_APP_CONFIG['_DOMAIN_ROOT']) ? $_APP_CONFIG['_DOMAIN_ROOT'] : '') ?>admin/sitemaps/post"
                  method="post" class="form-post label-design">

                <input type="hidden" id="sid" name="sid" class="object_id"
                       value="<?= (isset($object['sid']) ? $object['sid'] : '') ?>"/>

                <div class="row">


                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <input slug="sitemap_machine" type="text" name="sitemap_name"
                                   class="form-control document_title"
                                   id="sitemap_name"
                                   value="<?= (isset($object['sitemap_name']) ? $object['sitemap_name'] : '') ?>">
                            <label for="sitemap_name" class="control-label">Sitemap Name</label>
                        </div>
                        <div class="errors sitemap_name_errors"></div>
                    </div>


                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <input type="text" name="sitemap_machine" class="form-control document_slug"
                                   id="sitemap_machine"
                                   value="<?= (isset($object['sitemap_machine']) ? $object['sitemap_machine'] : '') ?>">
                            <label for="sitemap_machine" class="control-label">Sitemap Slug</label>
                        </div>
                        <div class="errors sitemap_machine_errors"></div>
                    </div>


                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <select class="form-control" id="namespace" name="namespace">
                                <? if (!empty($objects)): ?>
                                    <option value="">Select Namespace</option>
                                    <? foreach ($objects as $ns): ?>
                                        <option value="<?= $ns['namespace'] ?>"<? if (isset($object)): ?><?= ($ns['namespace'] == $object['sitemap_namespace'] ? ' selected' : '') ?><? endif ?>><?= $ns['namespace'] ?></option>
                                    <? endforeach ?>
                                <? endif ?>
                            </select>
                            <label for="namespace" class="control-label">Namespace</label>
                        </div>
                        <div class="errors namespace_errors"></div>
                    </div>
                </div>

                <div class="grid-x grid-margin-x align-center">
                    <div class="cell">
                        <div class="message"></div>
                    </div>
                </div>

                <div class="form-group row btn-container">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button class="btn custom-btn btn-info">
                            Save
                        </button>
                    </div>
                </div>

            </form>

        </main>
    </div>
</div>