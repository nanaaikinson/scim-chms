<mjml>
  <mj-body>
    <mj-section>
      <mj-column>
        <mj-text font-size="16px" font-weight="300">Hi</mj-text>
        <mj-text font-size="16px" font-weight="300">{{ ucfirst($data["user"]->name) }} from <strong></strong>tenant {{ $data["user"]->branch }}<strong></strong>, just {{ strtolower($data["action"]) }} this ticket with the following details.</mj-text>
        <mj-table font-size="16px">
          <tr>
            <td style="color: #e65100; font-weight:300">Title</td>
            <td style="font-weight:300">{{ $data["ticket"]->title }}</td>
          </tr>
          <tr>
            <td style="color: #e65100; font-weight:300">Priority</td>
            <td style="font-weight:300">{{ $data["ticket"]->priority }}</td>
          </tr>
          <tr>
            <td style="color: #e65100; font-weight:300">Tag</td>
            <td style="font-weight:300">{{ $data["ticket"]->tag }}</td>
          </tr>
          <tr>
            <td style="color: #e65100; font-weight:300">Description</td>
            <td style="font-weight:300">{!! $data["ticket"]->description !!}</td>
          </tr>
        </mj-table>
      </mj-column>
    </mj-section>
  </mj-body>
</mjml>
