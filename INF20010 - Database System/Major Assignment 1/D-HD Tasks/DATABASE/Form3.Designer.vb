<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class Form3
    Inherits System.Windows.Forms.Form

    'Form overrides dispose to clean up the component list.
    <System.Diagnostics.DebuggerNonUserCode()> _
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Required by the Windows Form Designer
    Private components As System.ComponentModel.IContainer

    'NOTE: The following procedure is required by the Windows Form Designer
    'It can be modified using the Windows Form Designer.  
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()> _
    Private Sub InitializeComponent()
        Me.txtDate = New System.Windows.Forms.TextBox()
        Me.lblDate = New System.Windows.Forms.Label()
        Me.txtProductID = New System.Windows.Forms.TextBox()
        Me.Label2 = New System.Windows.Forms.Label()
        Me.btnUpdate = New System.Windows.Forms.Button()
        Me.txtQuantity = New System.Windows.Forms.TextBox()
        Me.txtCustomerID = New System.Windows.Forms.TextBox()
        Me.Label4 = New System.Windows.Forms.Label()
        Me.Label1 = New System.Windows.Forms.Label()
        Me.txtDays = New System.Windows.Forms.TextBox()
        Me.btnCountSale = New System.Windows.Forms.Button()
        Me.txtSaleSince = New System.Windows.Forms.TextBox()
        Me.btnDeleteSale = New System.Windows.Forms.Button()
        Me.Label3 = New System.Windows.Forms.Label()
        Me.txtMinSaleID = New System.Windows.Forms.TextBox()
        Me.btnDeleteAllSale = New System.Windows.Forms.Button()
        Me.txtProdInfo = New System.Windows.Forms.TextBox()
        Me.btnGetAllSale = New System.Windows.Forms.Button()
        Me.Label5 = New System.Windows.Forms.Label()
        Me.Label6 = New System.Windows.Forms.Label()
        Me.Button1 = New System.Windows.Forms.Button()
        Me.btnNext = New System.Windows.Forms.Button()
        Me.Label7 = New System.Windows.Forms.Label()
        Me.Label8 = New System.Windows.Forms.Label()
        Me.SuspendLayout()
        '
        'txtDate
        '
        Me.txtDate.Location = New System.Drawing.Point(138, 97)
        Me.txtDate.Name = "txtDate"
        Me.txtDate.Size = New System.Drawing.Size(185, 22)
        Me.txtDate.TabIndex = 21
        '
        'lblDate
        '
        Me.lblDate.AutoSize = True
        Me.lblDate.Location = New System.Drawing.Point(5, 100)
        Me.lblDate.Name = "lblDate"
        Me.lblDate.Size = New System.Drawing.Size(36, 16)
        Me.lblDate.TabIndex = 20
        Me.lblDate.Text = "Date"
        '
        'txtProductID
        '
        Me.txtProductID.Location = New System.Drawing.Point(138, 41)
        Me.txtProductID.Name = "txtProductID"
        Me.txtProductID.Size = New System.Drawing.Size(185, 22)
        Me.txtProductID.TabIndex = 19
        '
        'Label2
        '
        Me.Label2.AutoSize = True
        Me.Label2.Location = New System.Drawing.Point(5, 44)
        Me.Label2.Name = "Label2"
        Me.Label2.Size = New System.Drawing.Size(69, 16)
        Me.Label2.TabIndex = 18
        Me.Label2.Text = "Product ID"
        '
        'btnUpdate
        '
        Me.btnUpdate.Location = New System.Drawing.Point(343, 12)
        Me.btnUpdate.Name = "btnUpdate"
        Me.btnUpdate.Size = New System.Drawing.Size(137, 107)
        Me.btnUpdate.TabIndex = 17
        Me.btnUpdate.Text = "Add Sale"
        Me.btnUpdate.UseVisualStyleBackColor = True
        '
        'txtQuantity
        '
        Me.txtQuantity.Location = New System.Drawing.Point(138, 69)
        Me.txtQuantity.Name = "txtQuantity"
        Me.txtQuantity.Size = New System.Drawing.Size(185, 22)
        Me.txtQuantity.TabIndex = 16
        '
        'txtCustomerID
        '
        Me.txtCustomerID.Location = New System.Drawing.Point(138, 13)
        Me.txtCustomerID.Name = "txtCustomerID"
        Me.txtCustomerID.Size = New System.Drawing.Size(185, 22)
        Me.txtCustomerID.TabIndex = 15
        '
        'Label4
        '
        Me.Label4.AutoSize = True
        Me.Label4.Location = New System.Drawing.Point(5, 72)
        Me.Label4.Name = "Label4"
        Me.Label4.Size = New System.Drawing.Size(55, 16)
        Me.Label4.TabIndex = 14
        Me.Label4.Text = "Quantity"
        '
        'Label1
        '
        Me.Label1.AutoSize = True
        Me.Label1.Location = New System.Drawing.Point(5, 16)
        Me.Label1.Name = "Label1"
        Me.Label1.Size = New System.Drawing.Size(80, 16)
        Me.Label1.TabIndex = 13
        Me.Label1.Text = "Customer ID"
        '
        'txtDays
        '
        Me.txtDays.Location = New System.Drawing.Point(138, 150)
        Me.txtDays.Multiline = True
        Me.txtDays.Name = "txtDays"
        Me.txtDays.Size = New System.Drawing.Size(185, 22)
        Me.txtDays.TabIndex = 22
        '
        'btnCountSale
        '
        Me.btnCountSale.Location = New System.Drawing.Point(343, 149)
        Me.btnCountSale.Name = "btnCountSale"
        Me.btnCountSale.Size = New System.Drawing.Size(137, 23)
        Me.btnCountSale.TabIndex = 23
        Me.btnCountSale.Text = "COUNT SALE SINCE"
        Me.btnCountSale.UseVisualStyleBackColor = True
        '
        'txtSaleSince
        '
        Me.txtSaleSince.Location = New System.Drawing.Point(138, 178)
        Me.txtSaleSince.Multiline = True
        Me.txtSaleSince.Name = "txtSaleSince"
        Me.txtSaleSince.Size = New System.Drawing.Size(185, 56)
        Me.txtSaleSince.TabIndex = 24
        '
        'btnDeleteSale
        '
        Me.btnDeleteSale.Location = New System.Drawing.Point(8, 267)
        Me.btnDeleteSale.Name = "btnDeleteSale"
        Me.btnDeleteSale.Size = New System.Drawing.Size(186, 23)
        Me.btnDeleteSale.TabIndex = 25
        Me.btnDeleteSale.Text = "DELETE SALE"
        Me.btnDeleteSale.UseVisualStyleBackColor = True
        '
        'Label3
        '
        Me.Label3.AutoSize = True
        Me.Label3.Location = New System.Drawing.Point(9, 302)
        Me.Label3.Name = "Label3"
        Me.Label3.Size = New System.Drawing.Size(75, 16)
        Me.Label3.TabIndex = 27
        Me.Label3.Text = "Min Sale ID"
        '
        'txtMinSaleID
        '
        Me.txtMinSaleID.Location = New System.Drawing.Point(138, 296)
        Me.txtMinSaleID.Name = "txtMinSaleID"
        Me.txtMinSaleID.Size = New System.Drawing.Size(185, 22)
        Me.txtMinSaleID.TabIndex = 26
        '
        'btnDeleteAllSale
        '
        Me.btnDeleteAllSale.Location = New System.Drawing.Point(222, 332)
        Me.btnDeleteAllSale.Name = "btnDeleteAllSale"
        Me.btnDeleteAllSale.Size = New System.Drawing.Size(247, 23)
        Me.btnDeleteAllSale.TabIndex = 28
        Me.btnDeleteAllSale.Text = "DELETE ALL SALE"
        Me.btnDeleteAllSale.UseVisualStyleBackColor = True
        '
        'txtProdInfo
        '
        Me.txtProdInfo.Location = New System.Drawing.Point(8, 361)
        Me.txtProdInfo.Multiline = True
        Me.txtProdInfo.Name = "txtProdInfo"
        Me.txtProdInfo.Size = New System.Drawing.Size(461, 372)
        Me.txtProdInfo.TabIndex = 30
        '
        'btnGetAllSale
        '
        Me.btnGetAllSale.Location = New System.Drawing.Point(8, 332)
        Me.btnGetAllSale.Name = "btnGetAllSale"
        Me.btnGetAllSale.Size = New System.Drawing.Size(208, 23)
        Me.btnGetAllSale.TabIndex = 29
        Me.btnGetAllSale.Text = "GET ALL SALE INFORMATION"
        Me.btnGetAllSale.UseVisualStyleBackColor = True
        '
        'Label5
        '
        Me.Label5.AutoSize = True
        Me.Label5.Location = New System.Drawing.Point(5, 156)
        Me.Label5.Name = "Label5"
        Me.Label5.Size = New System.Drawing.Size(76, 16)
        Me.Label5.TabIndex = 31
        Me.Label5.Text = "Days Since"
        '
        'Label6
        '
        Me.Label6.AutoSize = True
        Me.Label6.Location = New System.Drawing.Point(5, 201)
        Me.Label6.Name = "Label6"
        Me.Label6.Size = New System.Drawing.Size(72, 16)
        Me.Label6.TabIndex = 32
        Me.Label6.Text = "Sale Count"
        '
        'Button1
        '
        Me.Button1.Location = New System.Drawing.Point(504, 149)
        Me.Button1.Name = "Button1"
        Me.Button1.Size = New System.Drawing.Size(284, 206)
        Me.Button1.TabIndex = 33
        Me.Button1.Text = "Clear All"
        Me.Button1.UseVisualStyleBackColor = True
        '
        'btnNext
        '
        Me.btnNext.Location = New System.Drawing.Point(683, 680)
        Me.btnNext.Name = "btnNext"
        Me.btnNext.Size = New System.Drawing.Size(105, 53)
        Me.btnNext.TabIndex = 54
        Me.btnNext.Text = "Product Form"
        Me.btnNext.UseVisualStyleBackColor = True
        '
        'Label7
        '
        Me.Label7.AutoSize = True
        Me.Label7.Location = New System.Drawing.Point(501, 32)
        Me.Label7.Name = "Label7"
        Me.Label7.Size = New System.Drawing.Size(158, 16)
        Me.Label7.TabIndex = 59
        Me.Label7.Text = "STUDENT ID: 103802759"
        '
        'Label8
        '
        Me.Label8.AutoSize = True
        Me.Label8.Location = New System.Drawing.Point(501, 11)
        Me.Label8.Name = "Label8"
        Me.Label8.Size = New System.Drawing.Size(214, 16)
        Me.Label8.TabIndex = 58
        Me.Label8.Text = "STUDENT NAME: DANG VI LUAN"
        '
        'Form3
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(8.0!, 16.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(800, 742)
        Me.Controls.Add(Me.Label7)
        Me.Controls.Add(Me.Label8)
        Me.Controls.Add(Me.btnNext)
        Me.Controls.Add(Me.Button1)
        Me.Controls.Add(Me.Label6)
        Me.Controls.Add(Me.Label5)
        Me.Controls.Add(Me.txtProdInfo)
        Me.Controls.Add(Me.btnGetAllSale)
        Me.Controls.Add(Me.btnDeleteAllSale)
        Me.Controls.Add(Me.Label3)
        Me.Controls.Add(Me.txtMinSaleID)
        Me.Controls.Add(Me.btnDeleteSale)
        Me.Controls.Add(Me.txtSaleSince)
        Me.Controls.Add(Me.btnCountSale)
        Me.Controls.Add(Me.txtDays)
        Me.Controls.Add(Me.txtDate)
        Me.Controls.Add(Me.lblDate)
        Me.Controls.Add(Me.txtProductID)
        Me.Controls.Add(Me.Label2)
        Me.Controls.Add(Me.btnUpdate)
        Me.Controls.Add(Me.txtQuantity)
        Me.Controls.Add(Me.txtCustomerID)
        Me.Controls.Add(Me.Label4)
        Me.Controls.Add(Me.Label1)
        Me.Name = "Form3"
        Me.Text = "Form3"
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub

    Friend WithEvents txtDate As TextBox
    Friend WithEvents lblDate As Label
    Friend WithEvents txtProductID As TextBox
    Friend WithEvents Label2 As Label
    Friend WithEvents btnUpdate As Button
    Friend WithEvents txtQuantity As TextBox
    Friend WithEvents txtCustomerID As TextBox
    Friend WithEvents Label4 As Label
    Friend WithEvents Label1 As Label
    Friend WithEvents txtDays As TextBox
    Friend WithEvents btnCountSale As Button
    Friend WithEvents txtSaleSince As TextBox
    Friend WithEvents btnDeleteSale As Button
    Friend WithEvents Label3 As Label
    Friend WithEvents txtMinSaleID As TextBox
    Friend WithEvents btnDeleteAllSale As Button
    Friend WithEvents txtProdInfo As TextBox
    Friend WithEvents btnGetAllSale As Button
    Friend WithEvents Label5 As Label
    Friend WithEvents Label6 As Label
    Friend WithEvents Button1 As Button
    Friend WithEvents btnNext As Button
    Friend WithEvents Label7 As Label
    Friend WithEvents Label8 As Label
End Class
