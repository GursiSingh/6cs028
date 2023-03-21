<div class="container my-3 text-bg-dark">
    <h1> ACCOUNT </h1>
    <table class="table table-dark table-bordered border-light table-striped my-3">
        <tbody>
            <tr>
                <th scope="row">User Name</th>
                <td scope="row"><?=$userName?></td>
            </tr>
            <tr>
                <th scope="row">Email</th>
                <td scope="row"><?=$userEmail?></td>
            </tr>
            <tr>
                <th scope="row">Football Team</th>
                <td class="d-flex justify-content-between align-items-center" scope="row">
                    <div class="img">
                        
                        <img class="team-logo" src="<?=$userFootballTeamLogo?>" ><?=$userFootballTeamName?>
                    </div>
                    <div class="dropdown dropstart">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <form class="dropdown-menu p-4 text-bg-light" action="<?= base_url('/account')?>" method="post" id="footballForm">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="footballTeamId" class="form-label">Team</label>
                                <input type="text" class="form-control" name="footballTeamId" id="footballTeamId" onkeyup="getSearchDataFootball(this)" placeholder="<?=$userFootballTeamName?>" value="<?= set_value('footballTeamId')?>" style="width: 200px;" required>
                                <div class="dropList invisible" id="footballTeamList">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </td>
            </tr>
            <tr>
                <th scope="row">F1 Team</th>
                <td class="d-flex justify-content-between align-items-center" scope="row">
                    <div class="img">
                        <img class="team-logo" src="<?=$userF1TeamLogo?>" ><?=$userF1TeamName?>
                    </div>
                    <div class="dropdown dropstart">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <form class="dropdown-menu p-4" action="<?= base_url('/account')?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="f1TeamId" class="form-label">Team</label>
                                <input type="text" class="form-control" name="f1TeamId" id="f1TeamId" placeholder="<?=$userF1TeamName?>" placeholder="<?=$userF1TeamName?>" onkeyup="getSearchDataF1(this)" value="<?= set_value('f1TeamId')?>" style="width: 200px;">
                                <div class="dropList invisible" id="f1TeamList">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </td>
                
            </tr>

        </tbody>
        
    </table>
    <div class="d-grid">
        <a class="btn btn-danger btn-fill" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">DELETE ACCOUNT</a>
    </div>

    <div class="modal" id="deleteModal" tabindex="-1">
        <div class="modal-dialog ">
            <div class="modal-content text-bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Account</h5>
                    <button type="button btn-primary" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Confrim delete account?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                    <a type="button" class="btn btn-danger" id="deleteUser" href="<?= base_url('/account/delete')?>">DELETE</a>
                </div>
            </div>
        </div>
    </div>
</div>