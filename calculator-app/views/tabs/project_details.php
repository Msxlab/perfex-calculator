<!-- views/tabs/project_details.php -->
<div class="row g-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="fas fa-project-diagram text-primary me-2"></i>Project Details
                </h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Project Type</label>
                            <select class="form-select" id="projectType"
                                    onchange="calculator.data.projectDetails.projectType = this.value">
                                <option value="">Select project type</option>
                                <option value="Kitchen">Kitchen</option>
                                <option value="Bathroom">Bathroom</option>
                                <option value="Fireplace">Fireplace</option>
                                <option value="Vanity">Vanity</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Material Type</label>
                            <select class="form-select" id="materialType"
                                    onchange="calculator.data.projectDetails.materialType = this.value">
                                <option value="">Select material type</option>
                                <option value="Granite">Granite</option>
                                <option value="Marble">Marble</option>
                                <option value="Quartz">Quartz</option>
                                <option value="Quartzite">Quartzite</option>
                                <option value="Onyx">Onyx</option>
                                <option value="Dolomite">Dolomite</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Material Name</label>
                            <select class="form-select" id="materialName"
                                    onchange="calculator.data.projectDetails.materialName = this.value">
                                <option value="">Select material name</option>
                                <option value="ALL GROUPS A">ALL GROUPS A</option>
                                <option value="ALL GROUPS B">ALL GROUPS B</option>
                                <option value="ALL GROUPS C">ALL GROUPS C</option>
                            </select>
                        </div>
                    </div>
                    <!-- views/tabs/project_details.php içinde, material name seçiminden sonra -->
<div class="col-md-6">
    <div class="form-group">
        <label class="form-label">Material Price (per sqft)</label>
        <div class="input-group">
            <span class="input-group-text">$</span>
            <input type="number" 
                   class="form-control" 
                   id="materialPrice"
                   min="0" 
                   step="0.01"
                   value="0"
                   onchange="updateMaterialPrice(this.value)">
        </div>
    </div>
</div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Edge Type</label>
                            <select class="form-select" id="edgeType"
                                    onchange="calculator.data.projectDetails.edgeType = this.value">
                                <option value="">Select edge type</option>
                                <option value="Eased">Eased (Standard)</option>
                                <option value="Bullnose">Bullnose</option>
                                <option value="Bevel">Bevel</option>
                                <option value="Ogee">Ogee</option>
                                <option value="Double Ogee">Double Ogee</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Project Notes</label>
                            <textarea class="form-control" id="projectNotes" rows="3"
                                      placeholder="Enter any additional project notes"
                                      onchange="calculator.data.projectDetails.notes = this.value"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>