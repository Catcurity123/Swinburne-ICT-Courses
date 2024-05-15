namespace Part2_Form
{
    partial class Form1
    {
        private System.ComponentModel.IContainer components = null;

        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        private void InitializeComponent()
        {
            this.buttonShowMessage = new System.Windows.Forms.Button();
            this.buttonShowFunction = new System.Windows.Forms.Button();
            this.buttonShowFunction2 = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // buttonShowMessage
            // 
            this.buttonShowMessage.Location = new System.Drawing.Point(63, 76);
            this.buttonShowMessage.Name = "buttonShowMessage";
            this.buttonShowMessage.Size = new System.Drawing.Size(143, 23);
            this.buttonShowMessage.TabIndex = 0;
            this.buttonShowMessage.Text = "Click Me For Context";
            this.buttonShowMessage.UseVisualStyleBackColor = true;
            this.buttonShowMessage.Click += new System.EventHandler(this.buttonShowMessage_Click);
            // 
            // buttonShowFunction
            // 
            this.buttonShowFunction.Location = new System.Drawing.Point(93, 105);
            this.buttonShowFunction.Name = "buttonShowFunction";
            this.buttonShowFunction.Size = new System.Drawing.Size(75, 39);
            this.buttonShowFunction.TabIndex = 1;
            this.buttonShowFunction.Text = "Click Me for Function";
            this.buttonShowFunction.UseVisualStyleBackColor = true;
            this.buttonShowFunction.Click += new System.EventHandler(this.buttonShowFunction_Click);
            // 
            // buttonShowFunction2
            // 
            this.buttonShowFunction2.Location = new System.Drawing.Point(77, 150);
            this.buttonShowFunction2.Name = "buttonShowFunction2";
            this.buttonShowFunction2.Size = new System.Drawing.Size(103, 47);
            this.buttonShowFunction2.TabIndex = 2;
            this.buttonShowFunction2.Text = "Click me for another function";
            this.buttonShowFunction2.UseVisualStyleBackColor = true;
            this.buttonShowFunction2.Click += new System.EventHandler(this.buttonShowFunction2_Click);
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(284, 261);
            this.Controls.Add(this.buttonShowFunction2);
            this.Controls.Add(this.buttonShowFunction);
            this.Controls.Add(this.buttonShowMessage);
            this.Name = "Form1";
            this.Text = "Simple Form App";
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.Button buttonShowMessage;
        private System.Windows.Forms.Button buttonShowFunction;
        private System.Windows.Forms.Button buttonShowFunction2;
    }
}