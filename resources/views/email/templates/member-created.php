<mjml>
  <mj-body>
    <mj-section>
      <mj-column>
        <mj-text font-size="16px" font-weight="bold" padding-left="0">Hi {{ $data["name"] }}</mj-text>
        <mj-text font-size="16px" padding-left="0">Here is the code for you to login/verify your email.</mj-text>
        <mj-wrapper background-color="#EAF1FC">

          <mj-text align="center" font-size="20px" font-weight="bold">{{ $data["token"] }}</mj-text>
        </mj-wrapper>
        <mj-text padding-left="0" padding-bottom="0" font-style="italic">
          This code can only be used once, and it will only work on the form where it was requested. If it is not used, it will expire shortly. Do not forward this email.
        </mj-text>

        <mj-section padding-top="0" border-bottom="1px solid #d4d4d4"></mj-section>

        <mj-text font-size="16px" padding-left="0">SCIM Support</mj-text>
      </mj-column>
    </mj-section>
  </mj-body>
</mjml>
