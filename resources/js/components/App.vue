<template>
  <div class="container py-5 main">
		<div class="buttons float-right">
			<!-- Button Income modal -->
			<button
				type="button"
				class="btn btn-primary"
				data-toggle="modal"
				data-target="#IncomeModal"
			>
				Add Income
			</button>

			<!-- Button Expense modal -->
			<button
				type="button"
				class="btn btn-primary"
				data-toggle="modal"
				data-target="#ExpenseModal"
			>
				Add Expense
			</button>
		</div>

    <div class="row mt-5 ">
      <div class="col-lg-8 mx-auto text-center">
        <h1 class="display-6">Laravel Wallet</h1>
      </div>
    </div>

    <div id="" class="mt-3">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Date</th>
            <th scope="col">Amount</th>
            <th scope="col">Remark</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Income Modal -->
    <div
      class="modal fade"
      id="IncomeModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="IncomeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="IncomeModalLabel">Modal title</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">...</div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Expense Modal -->
    <div
      class="modal fade"
      id="ExpenseModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="ExpenseModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ExpenseModalLabel">Modal title</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">...</div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "App",
  data() {
    return {};
  },
};
</script>

<style>
</style>






