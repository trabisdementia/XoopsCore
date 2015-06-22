
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#general" aria-controls="general" role="tab" data-toggle="tab">
                <{xoicon icon="xicon-module"}>
                General
            </a>
        </li>
        <li role="presentation">
            <a href="#database" aria-controls="database" role="tab" data-toggle="tab">
                <{xoicon icon="xicon-database"}>
                DB Tables
            </a>
        </li>
        <li role="presentation">
            <a href="#blocks" aria-controls="blocks" role="tab" data-toggle="tab">
                <{xoicon icon="xicon-widgets"}>
                Blocks
            </a>
        </li>
        <li role="presentation">
            <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">
                <{xoicon icon="xicon-tools"}>
                Options
            </a>
        </li>
    </ul>

    <div class="tab-content module-details">
        <div role="tabpanel" class="tab-pane active" id="general">
            <header>
                <div class="media">
                    <div class="media-left">
                        <img src="../<{$module->getVar('dirname')}>/<{$module->getInfo('image')}>" alt="<{$module->getInfo('name')}>" class="media-object">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><{$module->getVar('name')}></h4>
                        <span class="help-block"><{$module->getInfo('description')}></span>
                    </div>
                </div>
            </header>


            <div class="row">

                <div class="col-sm-6 details-item">
                    <strong><{$systemLang.name}></strong>
                    <span><{$module->getVar('name')}></span>
                </div>

                <div class="col-sm-6 details-item">
                    <strong><{$systemLang.dirname}></strong>
                    <span><{$module->getVar('dirname')}></span>
                </div>

            </div>

            <div class="row">

                <div class="col-sm-6 details-item">
                    <strong><{$systemLang.version}></strong>
                    <span><{$module->getVar('version')}></span>
                </div>

                <div class="col-sm-6 details-item">
                    <strong><{$systemLang.license}></strong>
                    <span><{$module->getInfo('license')}></span>
                </div>

            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="database">Database</div>
        <div role="tabpanel" class="tab-pane" id="blocks">Blocks</div>
        <div role="tabpanel" class="tab-pane" id="settings">Settings</div>
    </div>
