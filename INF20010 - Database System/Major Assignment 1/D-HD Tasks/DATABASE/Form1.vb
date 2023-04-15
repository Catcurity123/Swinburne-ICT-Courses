Imports Oracle.ManagedDataAccess.Client
Imports System.Data.SqlClient
Imports System.Configuration


Public Class Form1
    '---------------------------------------- NAVIGATION AND CLEARING TEXT ----------------------------------------'
    Private Sub btnNext_Click(sender As Object, e As EventArgs) Handles btnNext.Click
        Form2.Show()
        Me.Hide()
    End Sub

    Public Sub ClearTextBoxes(frm As Form)
        For Each Control In frm.Controls
            If TypeOf Control Is TextBox Then
                Control.Text = ""
            End If
        Next Control
    End Sub

    Private Sub Button1_Click(sender As Object, e As EventArgs) Handles Button1.Click
        Call ClearTextBoxes(Me)
    End Sub

    '---------------------------------------- CONNECTION TO SWINBURNE DATABASE ----------------------------------------'
    Function GetConnectionString() As String
        Dim vConnStr As String
        vConnStr = "Data Source=(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)"
        vConnStr = vConnStr & "(HOST=feenix-oracle.swin.edu.au)(PORT=1521))"
        vConnStr = vConnStr & "(CONNECT_DATA=(SID=DMS)));"
        vConnStr = vConnStr & "User Id=s103802759;"
        vConnStr = vConnStr & "Password=200802;"
        Return vConnStr
    End Function

    Function CreateConnection() As OracleConnection
        Dim rvConn As New OracleConnection
        rvConn.ConnectionString = GetConnectionString()
        Return rvConn
    End Function


    '---------------------------------------- ADD NEW CUSTOMER ---------------------------------------- '
    Private Sub btnAdd_Click(sender As Object, e As EventArgs) Handles btnAddCustomer.Click
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        Dim cmd As New OracleCommand
        cmd.Connection = rvConn

        cmd.CommandType = CommandType.StoredProcedure
        cmd.CommandText = "ADD_CUST_TO_DB"
        cmd.Parameters.Add("pcustid", txtCustId.Text)
        cmd.Parameters.Add("pcustname", txtCustName.Text)

        Try
            rvConn.Open()
            cmd.ExecuteNonQuery()
            MessageBox.Show("Customer added OK")
        Catch ex As Exception
            MessageBox.Show(ex.Message)
        Finally
            rvConn.Close()
        End Try
    End Sub



    '---------------------------------------- Get Customer String ---------------------------------------- '
    Private Sub btnGetCustString_Click(sender As Object, e As EventArgs) Handles btnGetCustString.Click
        GET_CUST_STRING_FROM_DB()
    End Sub

    Private Sub GET_CUST_STRING_FROM_DB()
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        rvConn.Open()

        Dim cmd As New OracleCommand("GET_CUST_STRING_FROM_DB", rvConn)
        cmd.CommandType = CommandType.StoredProcedure

        Dim paramOracle As OracleParameter

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "vStringReturn"
        paramOracle.DbType = DbType.String
        paramOracle.Size = 20000

        paramOracle.Direction = ParameterDirection.ReturnValue
        cmd.Parameters.Add(paramOracle)

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "pcustid"
        paramOracle.DbType = DbType.Int16
        paramOracle.Value = txtCustId.Text
        cmd.Parameters.Add(paramOracle)


        Try

            cmd.ExecuteNonQuery()
            Dim vStr As String
            vStr = cmd.Parameters.Item("vStringReturn").Value.ToString
            txtDeletedRows.Text = txtDeletedRows.Text & Environment.NewLine & vStr


        Catch ex As Exception
            MessageBox.Show(String.Format("Error: {0}", ex.Message))
        Finally
            rvConn.Close()
        End Try
    End Sub

    '---------------------------------------- Update Customer Sale ---------------------------------------- '

    Private Sub btnUpdateSale_Click(sender As Object, e As EventArgs) Handles btnUpdateSale.Click
        UPD_CUST_SALESYTD_IN_DB()
    End Sub
    Private Sub UPD_CUST_SALESYTD_IN_DB()
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        rvConn.Open()

        Dim cmd As New OracleCommand("UPD_CUST_SALESYTD_IN_DB", rvConn)
        cmd.CommandType = CommandType.StoredProcedure

        Dim paramOracle As OracleParameter

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "pcustid"
        paramOracle.DbType = DbType.Int16
        paramOracle.Value = txtCustId.Text
        paramOracle.Direction = ParameterDirection.Input
        cmd.Parameters.Add(paramOracle)


        paramOracle = New OracleParameter
        paramOracle.ParameterName = "pamt"
        paramOracle.DbType = DbType.Int16
        paramOracle.Value = txtUpdatedSale.Text
        paramOracle.Direction = ParameterDirection.Input
        cmd.Parameters.Add(paramOracle)

        Try
            cmd.ExecuteNonQuery()
            MessageBox.Show("CUSTOMER SALES UPDATED OK")

        Catch ex As Exception
            MessageBox.Show(String.Format("Error: {0}", ex.Message))
        Finally
            rvConn.Close()
        End Try
    End Sub


    '---------------------------------------- Update Customer Status ---------------------------------------- '

    Private Sub btnUpdateStatus_Click(sender As Object, e As EventArgs) Handles btnUpdateStatus.Click
        UPD_CUST_STATUS_IN_DB()
    End Sub

    Private Sub UPD_CUST_STATUS_IN_DB()
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        rvConn.Open()

        Dim cmd As New OracleCommand("UPD_CUST_STATUS_IN_DB", rvConn)
        cmd.CommandType = CommandType.StoredProcedure

        Dim paramOracle As OracleParameter

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "pcustid"
        paramOracle.DbType = DbType.Int16
        paramOracle.Value = txtCustId.Text
        paramOracle.Direction = ParameterDirection.Input
        cmd.Parameters.Add(paramOracle)


        paramOracle = New OracleParameter
        paramOracle.ParameterName = "pstatus"
        paramOracle.DbType = DbType.String
        paramOracle.Value = txtUpdatedStatus.Text
        paramOracle.Direction = ParameterDirection.Input
        cmd.Parameters.Add(paramOracle)

        Try
            cmd.ExecuteNonQuery()
            MessageBox.Show("CUSTOMER STATUS UPDATED OK")

        Catch ex As Exception
            MessageBox.Show(String.Format("Error: {0}", ex.Message))
        Finally
            rvConn.Close()
        End Try
    End Sub

    '---------------------------------------- Get Total Customer Sale ---------------------------------------- '
    Private Sub btnGetSumProdSale_Click(sender As Object, e As EventArgs) Handles btnGetSumProdSale.Click
        SUM_CUST_SALESYTD()
    End Sub

    Private Sub SUM_CUST_SALESYTD()
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        rvConn.Open()

        Dim cmd As New OracleCommand("SUM_CUST_SALESYTD", rvConn)
        cmd.CommandType = CommandType.StoredProcedure

        Dim paramOracle As OracleParameter

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "vSum"
        paramOracle.DbType = DbType.Int16
        paramOracle.Size = 20000

        paramOracle.Direction = ParameterDirection.ReturnValue
        cmd.Parameters.Add(paramOracle)

        Try
            cmd.ExecuteNonQuery()
            Dim retInt As Int16
            retInt = cmd.Parameters.Item("vSum").Value.ToString
            txtProdSales.Text = txtProdSales.Text & Environment.NewLine & retInt


        Catch ex As Exception
            MessageBox.Show(String.Format("Error: {0}", ex.Message))
        Finally
            rvConn.Close()
        End Try
    End Sub

    '---------------------------------------- Delete All Customer ---------------------------------------- '
    Private Sub btnDeleteAllCustomer_Click(sender As Object, e As EventArgs) Handles btnDeleteAllCustomer.Click
        DELETE_ALL_CUSTOMERS_FROM_DB()
    End Sub

    Private Sub DELETE_ALL_CUSTOMERS_FROM_DB()
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        rvConn.Open()

        Dim cmd As New OracleCommand("DELETE_ALL_CUSTOMERS_FROM_DB", rvConn)
        cmd.CommandType = CommandType.StoredProcedure

        Dim paramOracle As OracleParameter

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "vRowDeleted"
        paramOracle.DbType = DbType.Int16
        paramOracle.Size = 20000

        paramOracle.Direction = ParameterDirection.ReturnValue
        cmd.Parameters.Add(paramOracle)

        Try
            cmd.ExecuteNonQuery()
            Dim retInt As Int16
            retInt = cmd.Parameters.Item("vRowDeleted").Value.ToString
            txtDeletedRows.Text = txtDeletedRows.Text & Environment.NewLine & retInt


        Catch ex As Exception
            MessageBox.Show(String.Format("Error: {0}", ex.Message))
        Finally
            rvConn.Close()
        End Try
    End Sub

    '---------------------------------------- GET ALL CUSTOMER INFO ---------------------------------------- '
    Private Sub btnGetAllCust_Click(sender As Object, e As EventArgs) Handles btnGetAllCust.Click
        GET_ALL_CUST()
    End Sub

    Private Sub GET_ALL_CUST()
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        Dim cmd As New OracleCommand("GET_PACK.GETALLCUST", rvConn)
        cmd.CommandType = CommandType.StoredProcedure

        Dim ParamOracle As OracleParameter
        ParamOracle = New OracleParameter
        ParamOracle.ParameterName = "CustCursor"
        ParamOracle.OracleDbType = OracleDbType.RefCursor
        ParamOracle.Direction = ParameterDirection.Output
        cmd.Parameters.Add(ParamOracle)

        Try
            rvConn.Open()
            Dim OracleRead As OracleDataReader
            OracleRead = cmd.ExecuteReader()
            If OracleRead.HasRows = True Then
                Dim CustString
                CustString = ""

                Do While OracleRead.Read()
                    CustString = CustString & ("Cust ID: " & OracleRead("CUSTID") & " Name: " & OracleRead("CUSTNAME") & " Status: " & OracleRead("STATUS") & " SalesYTD " & OracleRead("SALES_YTD")) & vbCrLf
                Loop
                cmd.CommandText = " BEGIN COMMIT; END;"
                cmd.CommandType = CommandType.Text
                txtCustInfo.Text = txtCustInfo.Text & Environment.NewLine & CustString
            Else
                MessageBox.Show("No rows found")
            End If
        Catch ex As Exception
            MessageBox.Show(String.Format("Error: {0}", ex.Message))
            cmd.CommandText = " BEGIN ROLLBACK; END;"
            cmd.CommandType = CommandType.Text
        Finally
            rvConn.Close()
        End Try
    End Sub

    '---------------------------------------- Add Simple Sale ---------------------------------------- '
    Private Sub btnUpdate_Click(sender As Object, e As EventArgs) Handles btnUpdate.Click
        ADD_SIMPLE_SALE_TO_DB()
    End Sub

    Private Sub ADD_SIMPLE_SALE_TO_DB()
        Dim rvConn As New OracleConnection
        rvConn = CreateConnection()
        rvConn.Open()

        Dim cmd As New OracleCommand("ADD_SIMPLE_SALE_TO_DB", rvConn)
        cmd.CommandType = CommandType.StoredProcedure

        Dim paramOracle As OracleParameter

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "pcustid"
        paramOracle.DbType = DbType.Int16
        paramOracle.Value = txtCustomerID.Text
        paramOracle.Direction = ParameterDirection.Input
        cmd.Parameters.Add(paramOracle)

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "pprodid"
        paramOracle.DbType = DbType.Int16
        paramOracle.Value = txtProductID.Text
        paramOracle.Direction = ParameterDirection.Input
        cmd.Parameters.Add(paramOracle)

        paramOracle = New OracleParameter
        paramOracle.ParameterName = "pqty"
        paramOracle.DbType = DbType.Int16
        paramOracle.Value = txtQuantity.Text
        paramOracle.Direction = ParameterDirection.Input
        cmd.Parameters.Add(paramOracle)

        Try
            cmd.ExecuteNonQuery()
            MessageBox.Show("SALES UPDATED OK")


        Catch ex As Exception
            MessageBox.Show(String.Format("Error: {0}", ex.Message))
        Finally
            rvConn.Close()
        End Try
    End Sub
End Class
