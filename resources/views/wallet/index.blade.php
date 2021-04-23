@extends('layouts.wallet')

@section('content')
    <div class="container pb-5 pt-2 main" id="wallet">

        <div class="row mt-0 mb-4 ">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="text-4xl	text-monospace">Laravel Wallet</h1>
            </div>
        </div>

        @if (auth()->user()->id ?? false)
            <div id="table" class="mt-3">
                <table class="table border border-dark ">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Remark</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($wallet)
                            <tr v-for="item, key in walletData" :key="item.id" :class="(item.type=='income') ? `bg-blue-100 ${item.id}_tr` : `bg-red-100 ${item.id}_tr`" >
                                <th scope="row">@{{ key+1 }}</th>
                                <td>@{{ item.date }}</td>
                                <td>@{{ item.amount }}</td>
                                <td>@{{ item.remark.substring(0, 10) }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" id="btn-edit-modal" data-target="#EditModal" v-on:click="editRow(item.id)">
                                        Edit
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger" v-on:click="deleteRow(item.id)">Delete</button>
                                </td>
                            </tr>
                            
                            {{-- Last Row Total  --}}
                            <tr class="bg-green-200">
                                <th scope="row"></th>
                                <td>Amount in wallet</td>
                                <td><span v-bind:value="total_amount">@{{total_amount}}$</span></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div> 
        @else
            <h1 class="text-danger text-center text-monospace p-5 mx-auto bg-blue-300 mt-3">
                Please login to access wallet data
            </h1>
        @endif


        {{-- modals --}}
        @auth
            <!-- Income Modal -->
            <div class="modal fade" id="IncomeModal" tabindex="-1" role="dialog" aria-labelledby="IncomeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="IncomeModalLabel">Income</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form role="form" data-action="">
                                <div class="form-group"> 
                                    <label for="amount">
                                        <h6>Amount *</h6>
                                    </label> 
                                    <input type="number" v-model="amount" min="0" name="amount" step="0.01" placeholder="Amount" required class="form-control " > 
                                    {{-- <small v-if="isNameInvalid" class="text-danger">Please enter valid name</small> --}}
                                </div>
                                <div class="form-group"> 
                                    <label for="date">
                                        <h6>Date *</h6>
                                    </label> 
                                    <input type="date" v-model="date" name="date" placeholder="" required class="form-control " > 
                                    {{-- <small v-if="isEmailInvalid" class="text-danger">Please enter valid email</small> --}}
                                </div>
                                <div class="form-group">  
                                    <label for="message">Remark</label>
                                    <textarea v-model="remark" class="form-control" maxlength="255" id="income_remark" rows="3" placeholder="Enter some remark" name="remark"  ></textarea>
                                    {{-- <small v-if="isMessageInvalid"  class="text-danger">Please enter valid message</small> --}}
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary" v-on:click="storeNew('income')">Save Income</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Expense Modal -->
            <div class="modal fade" id="ExpenseModal" tabindex="-1" role="dialog" aria-labelledby="ExpenseModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ExpenseModalLabel">Expense</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form role="form" id="form" data-action="">
                                <div class="form-group"> 
                                    <label for="amount">
                                        <h6>Amount *</h6>
                                    </label> 
                                    <input type="number" v-model="amount" min="0" name="amount"  step="0.01" placeholder="Amount" required class="form-control " > 
                                    {{-- <small v-if="isNameInvalid" class="text-danger">Please enter valid name</small> --}}
                                </div>
                                <div class="form-group"> 
                                    <label for="date">
                                        <h6>Date *</h6>
                                    </label> 
                                    <input type="date" v-model="date" name="date" placeholder="" required class="form-control " > 
                                    {{-- <small v-if="isEmailInvalid" class="text-danger">Please enter valid email</small> --}}
                                </div>
                                <div class="form-group">  
                                    <label for="message">Remark</label>
                                    <textarea v-model="remark" class="form-control" maxlength="255" id="expense_remark" rows="3" placeholder="Enter some remark" name="remark"  ></textarea>
                                    {{-- <small v-if="isMessageInvalid"  class="text-danger">Please enter valid message</small> --}}
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary" v-on:click="storeNew('expense')">Save Expense</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="ExpenseModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ExpenseModalLabel">@{{ edit_row.type}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form role="form" id="form" data-action="">
                                <div class="form-group"> 
                                    <label for="amount">
                                        <h6>Amount *</h6>
                                    </label> 
                                    <input type="number" v-model="edit_row.amount" min="0" name="amount"  step="0.01" placeholder="Amount" required class="form-control " > 
                                </div>
                                <div class="form-group"> 
                                    <label for="date">
                                        <h6>Date *</h6>
                                    </label> 
                                    <input type="date" v-model="edit_row.date" name="date" placeholder="" required class="form-control " > 
                                </div>
                                <div class="form-group">  
                                    <label for="message">Remark</label>
                                    <textarea v-model="edit_row.remark" class="form-control" maxlength="255" id="expense_remark" rows="3" placeholder="Enter some remark" name="remark"  ></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary" v-on:click="updateRow(edit_row.id)">Update @{{  edit_row.type }}</button>
                        </div>
                    </div>
                </div>
            </div>
        @endauth

    </div>

@endsection

@auth
    <script>
        var walletDatas = {!! $wallet !!}
    </script>

@endauth

@section('scripts')

    const wallet = new Vue({
        el: '#wallet',
        data: {
            total_amount: '0.00',
            id: '',
            amount: '',
            remark: '',
            date: '',
            edit_row: '',
            walletData: {!! json_encode($wallet) !!},
        },
        created() {
            // console.log(this.walletData[0]);
            this.updateTotal();
        },
        methods: {
            updateTotal() { 
                var total = parseFloat(0);
                this.walletData.map(item => {
                    if(item.type == 'income') {
                        total += parseFloat(item.amount);
                    } else {
                        total -= parseFloat(item.amount);
                    }
                });

                this.total_amount = total;

            },
            async editRow(row_id) {
                var index = '';
                var row = this.walletData.find((item, key) => {
                    if(item.id == row_id) {
                        index = key;
                        return true;
                    }
                    return false;
                });

                this.edit_row = row;
                this.edit_row.index = index;
                
            },
            async updateRow(row_id) {

                var data = {
                    id: this.edit_row.id,
                    date: this.edit_row.date,
                    amount: this.edit_row.amount,
                    remark: this.edit_row.remark,
                    type: this.edit_row.type,
                };

                await axios.put(`wallet/${row_id}`, data)
                    .then(function (response) {
                        
                        var res = response.data;

                        this.walletData[this.edit_row.index].date = res.date;
                        this.walletData[this.edit_row.index].amount = res.amount;
                        this.walletData[this.edit_row.index].remark = res.remark;

                        this.updateTotal();

                        this.id = this.date = this.amount = this.remark = '';

                    }.bind(this))
                    .catch(function (error) {
                        console.log(error);
                    });

                this.edit_row = {};
            },
            async storeNew(type) {
                
                var data = {
                    id: this.id,
                    date: this.date,
                    amount: this.amount,
                    remark: this.remark,
                    type: type,
                };

                var new_data = await axios.post(`wallet`, data)
                    .then(function (response) {
                        var res = response.data;                        
                        return res;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                
                this.walletData.push(new_data);

                this.id = this.date = this.amount = this.remark = '';

                this.updateTotal();

            },
            async deleteRow(row_id) {
                var data = this.id
                await axios.delete(`wallet/${row_id}`)
                .then(res => {
                    
                })
                .catch(err => {
                    console.log('catch deleteRow'+id);
                });
                
                this.walletData = this.walletData.filter(function(value, index){ 
                    return value.id != row_id;
                });

                this.updateTotal();
            }
        }
    });
@endsection